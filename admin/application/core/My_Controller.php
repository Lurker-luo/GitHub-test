<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 自定义父级控制器
 * Enter description here ...
 * @author BenBen
 *
 */
class My_Controller extends CI_Controller {

	protected $user=null;
	/**
	 * 构造函数
	 * Enter description here ...
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('RoleModel');
		$this->load->model('NodeModel');
		$this->load->model('AccessModel');
		$this->load->library('Tree');
		//验证登录
		$this->check_login();
		//验证权限
		$this->check_right();
	}
	/**
	 * 验证权限
	 * Enter description here ...
	 */
	function check_right(){
		$user=$this->session->userdata('user');//管理员信息
		if ($user['username']=='jooli'){
			return;
		}
		$accessList=$this->AccessModel->getListByWhere('role_id='.$user['role_id']);//所有权限
		if ($accessList){
			$request = uri_string();
			//解析请求页面和其它GET变量
			$parsed = explode('/' , $request);
			//页面是第一个元素
			$module_name = array_shift($parsed);//模块名称
			if ($module_name!='Index'){//默认模块，不用验证
				$action=$parsed[0];//操作名称
				//验证模块权限
				$module=$this->NodeModel->getNode("name='".$module_name."'");
				$access=$this->AccessModel->GetAccess('role_id='.$user['role_id'].' AND node_id='.$module['id']);
				if ($access){
					//验证操作权限
					$no=$this->NodeModel->getNode("name='".$action."' AND pid=".$module['id']);
					if ($no){
						$access=$this->AccessModel->GetAccess('role_id='.$user['role_id'].' AND node_id='.$no['id']);
						if (!$access){
							show_error('index.php/Index/index',500,'提示信息：您没有此操作权限,请联系管理员！');
						}
					}
				}else{
					show_error('index.php/Index/index',500,'提示信息：您没有此操作权限,请联系管理员！');
				}
			}
		}else{
			show_error('index.php/Login/index',500,'提示信息：您的帐号未配置任何操作权限,请联系管理员！');
		}
	}
	/**
	 * 验证登录状态
	 * Enter description here ...
	 */
	function check_login(){
		if (!$this->session->userdata('user')){
			show_error('index.php/Login/index',500,'提示信息：请登录后再操作！');
		}
		$this->user=$this->session->userdata('user');
	}
}
