<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends My_Controller {
	/**
	 * 构造函数
	 * Enter description here ...
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('RoleModel');
		$this->load->library('Page');
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
		$pageSize=12;
		$pageIndex=$this->input->get('page')?$this->input->get('page'):1;
		$strWhere='level>'.$level.' OR level='.$level;
		$orderBy='';
		$totalCount=$this->UserModel->getUserCountByWhere($strWhere);
		$users=$this->UserModel->getUserByPage($pageSize,$pageIndex,$strWhere,$orderBy);
		$page=new Page();
		$str_page=$page->create($pageIndex, $pageSize, $totalCount, array(), array());
		$data['page']=$str_page;
		$data['users']=$users;
		$this->load->view('User/list',$data);
	}
	/**
	 * 添加用户
	 * Enter description here ...
	 */
	public function add(){
		$cmd=$this->input->post('cmd');
		if ($cmd&&$cmd=='submit'){
			$dataArray=array(
				'username'=>$this->input->post('username'),
				'password'=>md5($this->input->post('password')),
				'role_id'=>$this->input->post('role_id'),
				'status'=>$this->input->post('status')
			);
			$result=$this->UserModel->addUser($dataArray);
			if ($result){
				show_error('index.php/User/index',500,'提示信息：管理员添加成功！');
			}else{
				show_error('index.php/User/add',500,'提示信息：管理员添加失败！');
			}
		}else{
			$user=$this->user;
			$role=$this->RoleModel->getRole('id='.$user['role_id']);
			$level=$role['level'];//用户角色等级
			$roles=$this->RoleModel->getListByWhere('status=1 AND (level>'.$level.' OR id='.$role['id'].')');
			$data['roles']=$roles;
			$tree=new Tree();
			$this->load->view('User/add',array('roles'=>$tree->create($roles,$role['pid'])));
		}
	}
	/**
	 * 编辑用户
	 * Enter description here ...
	 */
	public function edit(){
		$cmd=$this->input->post('cmd');
		if ($cmd&&$cmd=='submit'){
			$id=$this->input->post('id');
			$model=$this->UserModel->getUser('id='.$id);
			if ($model){
				$dataArray=array();
				if ($this->input->post('password')==$model['password']){
					$dataArray=array(
						'username'=>$this->input->post('username'),
						'role_id'=>$this->input->post('role_id'),
						'status'=>$this->input->post('status')
					);
				}else{
					$dataArray=array(
						'username'=>$this->input->post('username'),
						'password'=>md5($this->input->post('password')),
						'role_id'=>$this->input->post('role_id'),
						'status'=>$this->input->post('status')
					);
				}
				$result=$this->UserModel->editUser($dataArray,'id='.$id);
				if ($result){
					show_error('index.php/User/index',500,'提示信息：管理员修改成功！');
				}else{
					show_error('index.php/User/edit',500,'提示信息：管理员修改失败！');
				}
			}else{
				show_error('index.php/User/edit',500,'提示信息：管理员帐号或已被删除！');
			}
		}else{
			$id=$this->input->get('id');
			if ($id){
				$model=$this->UserModel->getUser('id='.$id);
				if ($model){
					$user=$this->user;
					$role=$this->RoleModel->getRole('id='.$user['role_id']);
					$level=$role['level'];//用户角色等级
					$roles=$this->RoleModel->getListByWhere('status=1 AND (level>'.$level.' OR id='.$role['id'].')');
					$tree=new Tree();
					$this->load->view('User/edit',array('roles'=>$tree->create($roles,$role['pid']),'model'=>$model));
				}else{
					show_error('index.php/User/edit',500,'提示信息：管理员帐号或已被删除！');
				}
			}else{
				show_error('index.php/User/edit',500,'提示信息：参数错误！');
			}
		}
	}
}
