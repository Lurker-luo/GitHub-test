<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends My_Controller {
	/**
	 * 构造函数
	 * Enter description here ...
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 默认函数
	 * Enter description here ...
	 */
	public function index()
	{
		$this->load->view('Index/index');
	}
	/**
	 * 框架左侧菜单
	 * Enter description here ...
	 */
	public function left()
	{
		$user=$this->user;
		//取出当前登录用户所有模块权限(英文名称)及操作权限(ID)
		$accessList=$this->AccessModel->getListByWhere('role_id='.$user['role_id']);
		$module_id='';//模块ID
		$node_id='';//所有权限ID
		$nodes='';//模块下所有权限
		foreach ($accessList as $access){
			$node_id.=$access['node_id'].',';
		}
		//查询权限节点
		$menu=array();
		$k=0;
		if ($this->input->get('id')){
			$module_id=$this->input->get('id');
		}else{
			$nodes=$this->NodeModel->getListByWhere('level=1 ORDER BY sort ASC');
			for ($i=0;$i<count($nodes);$i++){
				if (in_array($nodes[$i]['id'],explode(',', $node_id))){
					$module_id=$nodes[$i]['id'];
					break;
				}
			}
		}
		$nodes=$this->NodeModel->getListByWhere('type=1 AND pid='.$module_id);
		for ($i=0;$i<count($nodes);$i++){
			if (in_array($nodes[$i]['id'],explode(',', $node_id))){
				$menu[$k]=$nodes[$i];
				$child=$this->NodeModel->getListByWhere('type=1 AND pid='.$nodes[$i]['id']);
				for ($j=0;$j<count($child);$j++){
					if (in_array($child[$j]['id'],explode(',', $node_id))){
						$menu[$k]['child'][]=$child[$j];
					}
				}
				$k++;
			}
		}
		$data['user']=$this->user;
		$data['nodes']=$menu;
		$this->load->view('Index/left',$data);
	}
	/**
	 * 框架右侧内容
	 * Enter description here ...
	 */
	public function right()
	{
		$data['user']=$this->user;
		$this->load->view('Index/right',$data);
	}
	/**
	 * 框架顶部
	 * Enter description here ...
	 */
	public function top()
	{
		$menu=null;
		$user=$this->user;
		if ($user['username']=='jooli'){
			$menu=$this->NodeModel->getListByWhere('type=1 AND level=1');//所有一级权限
		}else{
			//取出当前登录用户所有模块权限(英文名称)及操作权限(ID)
			$accessList=$this->AccessModel->getListByWhere('role_id='.$user['role_id']);
			$module='';
			$node_id='';
			foreach ($accessList as $access){
				$node_id.=$access['node_id'].',';
			}
			//查询权限节点
			$data=array();
			$k=0;
			$menu=$this->NodeModel->getListByWhere('type=1 AND level=1');
			for ($i=0;$i<count($menu);$i++){
				if (in_array($menu[$i]['id'],explode(',', $node_id))){
					$data[$k]=$menu[$i];
					$k++;
				}
			}
			$menu=$data;
		}
		$data['user']=$this->user;
		$data['menu']=$menu;
		$this->load->view('Index/top',$data);
	}
}
