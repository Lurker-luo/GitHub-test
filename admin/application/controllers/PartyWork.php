<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PartyWork extends My_Controller {
	/**
	 * 构造函数
	 * Enter description here ...
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('PartyWorkModel');
		$this->load->library('Page');
	}
	/**
	 * 默认函数
	 * Enter description here ...
	 */
	public function index(){
		$pageSize=5;
		$pageIndex=$this->input->get('page')?$this->input->get('page'):1;
		$selParam="a.section_name as asection_name,b.*";
		$dataSet="dx_section a INNER JOIN dx_section b ON a.id = b.pid";
		$strWhere="a.id = 3 and b.grade = 3";
		$orderBy='';
		$totalCount=$this->PartyWorkModel->getListCountByWhere($dataSet,$strWhere);
		$PartyWork=$this->PartyWorkModel->getListByPage($pageSize,$pageIndex,$selParam,$dataSet,$strWhere,$orderBy);
		$page=new Page();
		$str_page=$page->create($pageIndex, $pageSize, $totalCount, array(), array());
		$data=array(
			'page'=>$str_page,
			'PartyWork'=>$PartyWork
		);
		$this->load->view('PartyWork/list',$data);
	}
	/**
	 * 添加用户
	 * Enter description here ...
	 */
	public function add(){
		$cmd=$this->input->post('cmd');
		if ($cmd&&$cmd=='submit'){
			$dataArray=array(
				'pid'=>$this->input->post('pid'),
				'section_name'=>$this->input->post('section_name'),
				'author'=>$this->input->post('author'),
				'source'=>$this->input->post('source'),
				'content'=>$this->input->post('content'),
				'grade'=> 3,
				'status'=>1
			);
			$result=$this->PartyWorkModel->add($dataArray);
			if ($result){
				show_error('index.php/PartyWork/index',500,'提示信息：党校简介添加成功！');
			}else{
				show_error('index.php/PartyWork/add',500,'提示信息：党校简介添加失败！');
			}
		}else{
			$parent=$this->PartyWorkModel->getList( " pid=1 and  grade = 2 ");
			$this->load->view('PartyWork/add',array('parent'=>$parent));
		}
	}
	/**
	 * 编辑网站简介
	 * Enter description here ...
	 */
	public function edit(){
		$cmd=$this->input->post('cmd');
		if ($cmd&&$cmd=='submit'){
			$id=$this->input->post('id');
			$dataArray=array(
				'section_name'=>$this->input->post('section_name'),
				'author'=>$this->input->post('author'),
				'source'=>$this->input->post('source'),
				'content'=>$this->input->post('content')
			);//print_r($dataArray);exit;
			$result=$this->PartyWorkModel->edit($dataArray,'id='.$id);
			if ($result){
				show_error('index.php/PartyWork/index',500,'提示信息：党校简介修改成功！');
				echo "信息修改成功！";
			}else{
				show_error('index.php/PartyWork/edit',500,'提示信息：党校简介修改失败！');
			}
		}else{
			$selParam="";
			$dataSet="dx_section a INNER JOIN dx_section b ON a.id = b.pid";
			$strWhere="a.id = 3 and b.grade = 3";
			$orderBy='';
			$query=$this->PartyWorkModel->getListByJoin($selParam,$dataSet,$strWhere,$orderBy);
			$id= $query['id'];//单页栏目,选择最新的函数
			if ($id){
				$PartyWork=$this->PartyWorkModel->getModel('id='.$id);
				if ($PartyWork){
					$parent=$this->PartyWorkModel->getList('id = 2');
					$this->load->view('PartyWork/edit',array('PartyWork'=>$PartyWork,'parent'=>$parent));
				}else{
					show_error('index.php/PartyWork/index',500,'提示信息：你要修改的党校简介不存在或者已被删除！');
				}
			}else{
				show_error('index.php/PartyWork/index',500,'提示信息：参数错误！');
			}
		}
	}
}