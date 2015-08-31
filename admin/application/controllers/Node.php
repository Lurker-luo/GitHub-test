<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Node extends My_Controller {
	/**
	 * 构造函数
	 * Enter description here ...
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('NodeModel');
		$this->load->library('Tree');
		$this->load->library('Page');
	}

	/**
	 * 默认函数
	 * Enter description here ...
	 */
	public function index()
	{
		$user=$this->user;
		$pageSize=100;
		$pageIndex=$this->input->get('page')?$this->input->get('page'):1;
		//取出当前登录用户所有模块权限(英文名称)及操作权限(ID)
		$accessList=$this->AccessModel->getListByWhere('role_id='.$user['role_id']);
		$node_id='';//所有权限ID
		foreach ($accessList as $access){
			$node_id.=$access['node_id'].',';
		}
		$strWhere=' id IN ('.rtrim($node_id,',').')';
		$orderBy='';
		$totalCount=$this->NodeModel->getNodeCountByWhere($strWhere);
		$result=$this->NodeModel->getNodeByPage($pageSize,$pageIndex,$strWhere,$orderBy);
		$page=new Page();
		$tree=new Tree();
		$str_page=$page->create($pageIndex, $pageSize, $totalCount, array(), array());
		$data['page']=$str_page;
		$data['result']=$tree->create($result);
		$this->load->view('Node/list',$data);
	}
	/**
	 * 添加权限
	 * Enter description here ...
	 */
	public function add(){
		$cmd=$this->input->post('cmd');
		if ($cmd&&$cmd=='submit'){
			$dataArray=array(
				'name'=>$this->input->post('name'),
				'title'=>$this->input->post('title'),
				'level'=>$this->input->post('level'),
				'pid'=>$this->input->post('pid'),
				'sort'=>$this->input->post('sort'),
				'remark'=>$this->input->post('remark'),
				'type'=>$this->input->post('type'),
				'status'=>$this->input->post('status')
			);
			$result=$this->NodeModel->addNode($dataArray);
			if ($result){
				show_error('index.php/Node/index',500,'提示信息：用户权限添加成功！');
			}else{
				show_error('index.php/Node/add',500,'提示信息：用户权限添加失败！');
			}
		}else{
			$user=$this->user;
			$role=$this->RoleModel->getRole('id='.$user['role_id']);
			//取出当前登录用户所有模块权限(英文名称)及操作权限(ID)
			$accessList=$this->AccessModel->getListByWhere('role_id='.$user['role_id']);
			$node_id='';//所有权限ID
			foreach ($accessList as $access){
				$node_id.=$access['node_id'].',';
			}
			$parent=$this->NodeModel->getListByWhere('status=1 AND level<3 AND id IN ('.rtrim($node_id,',').')');
			$tree=new Tree();
			$this->load->view('Node/add',array('parent'=>$tree->create($parent),'level'=>$role['level']));
		}
	}
	/**
	 * 编辑权限
	 * Enter description here ...
	 */
	public function edit(){
		$cmd=$this->input->post('cmd');
		if ($cmd&&$cmd=='submit'){
			$node_id=$this->input->post('node_id');
			$dataArray=array(
				'name'=>$this->input->post('name'),
				'title'=>$this->input->post('title'),
				'level'=>$this->input->post('level'),
				'pid'=>$this->input->post('pid'),
				'sort'=>$this->input->post('sort'),
				'remark'=>$this->input->post('remark'),
				'type'=>$this->input->post('type'),
				'status'=>$this->input->post('status')
			);
			$result=$this->NodeModel->editNode($dataArray,'id='.$node_id);
			if ($result){
				show_error('index.php/Node/index',500,'提示信息：用户权限修改成功！');
			}else{
				show_error('index.php/Node/edit',500,'提示信息：用户权限修改失败！');
			}
		}else{
			$node_id=$this->input->get('id');
			if ($node_id){
				$node=$this->NodeModel->getNode('id='.$node_id);
				if ($node){
					$user=$this->user;
					$role=$this->RoleModel->getRole('id='.$user['role_id']);
					//取出当前登录用户所有模块权限(英文名称)及操作权限(ID)
					$accessList=$this->AccessModel->getListByWhere('role_id='.$user['role_id']);
					$node_id='';//所有权限ID
					foreach ($accessList as $access){
						$node_id.=$access['node_id'].',';
					}
					$parent=$this->NodeModel->getListByWhere('status=1 AND level<3 AND id IN ('.rtrim($node_id,',').')');
					$tree=new Tree();
					$this->load->view('Node/edit',array('node'=>$node,'parent'=>$tree->create($parent),'level'=>$role['level']));
				}else{
					show_error('index.php/Node/index',500,'提示信息：参数错误！');
				}
			}else{
				show_error('index.php/Node/index',500,'提示信息：权限不存在！');
			}
		}
	}
}
