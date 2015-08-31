<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Role extends My_Controller {
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
		$this->load->library('Page');
		$this->load->library('Tree');
	}

	/**
	 * 默认函数
	 * Enter description here ...
	 */
	public function index()
	{
		$user=$this->user;
		$role=$this->RoleModel->getRole('id='.$user['role_id']);
		$level=$role['level'];//用户角色等级
		$roles=array();
		if ($level=='1'||$level=='2'){
			$roles=$this->RoleModel->getListByWhere('level>='.$role['level']);
		}else if ($level=='3'){
			$roles=$this->RoleModel->getListByWhere('id='.$role['id'].' OR pid='.$role['id']);
		}else if ($level=='4'){//四级管理员无权进入该页面
			show_error('index.php/Index/index',500,'提示信息：很抱歉，您无权操作该页面！');
		}
		$tree=new Tree();
		$this->load->view('Role/list',array('roles'=>$tree->create($roles,$role['pid'])));
	}
	/**
	 * 添加用户
	 * Enter description here ...
	 */
	public function add(){
		$cmd=$this->input->post('cmd');
		if ($cmd&&$cmd=='submit'){
			$pid=$this->input->post('pid');//上级ID，计算level
			$role=$this->RoleModel->getRole(array('id'=>$pid));
			if ($role){
				$level=(int)$role['level']+1;
				$dataArray=array(
					'name'=>$this->input->post('name'),
					'remark'=>$this->input->post('remark'),
					'status'=>$this->input->post('status'),
					'level'=>$level,
					'pid'=>$pid,
					'create_time'=>now(),
					'update_time'=>now()
				);
				$result=$this->RoleModel->addRole($dataArray);
				if ($result){
					show_error('index.php/Role/index',500,'提示信息：用户组添加成功！');
				}else{
					show_error('index.php/Role/add',500,'提示信息：用户组添加失败！');
				}
			}else{
				show_error('index.php/Role/add',500,'提示信息：继承用户组选择错误！');
			}
		}else{
			$user=$this->user;
			$role=$this->RoleModel->getRole('id='.$user['role_id']);
			$parent=array();
			$tree=new Tree();
			$level=$role['level'];//用户角色等级
			if ($level=='1'||$level=='2'){
				$parent=$this->RoleModel->getListByWhere('status=1 AND level BETWEEN '.$role['level'].' AND 3');
				$parent=$tree->create($parent,$role['pid']);
			}else if ($level=='3'){
				$parent=$role;
			}else if ($level=='4'){//四级管理员无权进入该页面
				show_error('index.php/Index/index',500,'提示信息：很抱歉，您无权操作该页面！');
			}
			$this->load->view('Role/add',array('parent'=>$parent,'level'=>$level));
		}
	}
	/**
	 * 权限配置
	 * Enter description here ...
	 */
	public function access(){
		$cmd=$this->input->post('cmd');
		if ($cmd&&$cmd=='submit'){
			$access=$this->input->post('access');//接受到的权限
			$role_id=$this->input->post('role_id');
			if (!$role_id){
				show_error('index.php/Role/list',500,'提示信息：参数错误！');
			}
			$role=$this->RoleModel->getRole('id='.$role_id);
			if (!$role){
				show_error('index.php/Role/list',500,'提示信息：参数错误！');
			}
			$this->AccessModel->delAccess('role_id='.$role['id']);//删除现有权限
			$flag=0;
			if ($access){
				$dataArray=array();
				foreach ($access as $value){
					$tmp=explode('_', $value);
					$dataArray=array(
    					'role_id'=>$role['id'],
    					'node_id'=>$tmp[0],
    					'level'=>$tmp[1]
					);
					$flag+=$this->AccessModel->addAccess($dataArray);
				}
				if ($flag>0){
					show_error('index.php/Role/access?id='.$role_id,500,'提示信息：角色权限配置成功！');
				}else{
					show_error('index.php/Role/access?id='.$role_id,500,'提示信息：角色权限配置失败！');
				}
			}else{
				show_error('index.php/Role/access?id='.$role_id,500,'提示信息：请为用户组选择权限！');
			}
		}else{
			if (!$this->input->get('id')){
				show_error('index.php/Role/index',500,'提示信息：参数错误！');
			}
			$role=$this->RoleModel->getRole('id='.$this->input->get('id'));
			if (!$role){
				show_error('index.php/Role/index',500,'提示信息：参数错误！');
			}
			$user=$this->user;//登录用户
			$nodes=$this->NodeModel->getListByWhere('status=1');//所有权限节点
			$right=array();//存放用户当前拥有的权限
			if ($user['username']=='jooli'){//超级管理员加载所有权限
				foreach ($nodes as $value){
					$access=$this->AccessModel->getAccess('role_id='.$role['id'].' AND node_id='.$value['id']);
					if ($access){
						$value['access']=1;
					}else{
						$value['access']=0;
					}
					$right[]=$value;
				}
			}else{//加载自己有的权限
				foreach ($nodes as $value){
					$access=$this->AccessModel->getAccess('role_id='.$user['id'].' AND node_id='.$value['id']);//查询登录用户是否有此权限
					if ($access){
						$ac=$this->AccessModel->getAccess('role_id='.$role['id'].' AND node_id='.$value['id']);//查询要分配的角色是否有此权限
						if ($ac){
							$value['access']=1;
						}else{
							$value['access']=0;
						}
						$right[]=$value;
					}
				}
			}
			$tree=new Tree();
			$data['role']=$role;
			$data['nodes']=$tree->create($right);
			$this->load->view('Role/access',$data);
		}
	}
}