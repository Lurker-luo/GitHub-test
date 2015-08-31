<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class   控制器名字   extends My_Controller {
	/**
	 * 构造函数
	 * Enter description here ...
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('CircleModel');//在初始化时加载
		$this->load->library('Page');//分页函数
	}
	/**
	 * 默认函数
	 * Enter description here ...
	 */
	public function index()
	{
		$pageSize=12;
		$pageIndex=$this->input->get('page')?$this->input->get('page'):1;
		$strWhere=' a.pid!=0';
		$orderBy='';
		$totalCount=$this->CircleModel->getCircleCountByWhere($strWhere);
		$circle=$this->CircleModel->getCircleByPage($pageSize,$pageIndex,$strWhere,$orderBy);
		$page=new Page();
		$str_page=$page->create($pageIndex, $pageSize, $totalCount, array(), array());
		$this->load->view('Circle/list',array('page'=>$str_page,'circle'=>$circle));
	}
	/**
	 * 添加用户
	 * Enter description here ...
	 */
	public function add(){
		$cmd=$this->input->post('cmd');
		if ($cmd&&$cmd=='submit'){
			$dataArray=array(
				'name'=>$this->input->post('name'),
				'pid'=>$this->input->post('pid'),
				'logo'=>$this->input->post('logo'),
				'thumb'=>$this->input->post('logo'),
				'intro'=>$this->input->post('intro'),
				'create_time'=>now()
			);
			$result=$this->CircleModel->add($dataArray);
			if ($result){
				show_error('index.php/Circle/index',500,'提示信息：圈子添加成功！');
			}else{
				show_error('index.php/Circle/add',500,'提示信息：圈子添加失败！');
			}
		}else{
			$parent=$this->CircleModel->getList('pid=0');
			$this->load->view('Circle/add',array('parent'=>$parent));
		}
	}
	/**
	 * 编辑圈子
	 * Enter description here ...
	 */
	public function edit(){
		$cmd=$this->input->post('cmd');
		if ($cmd&&$cmd=='submit'){
			$id=$this->input->post('id');
			$dataArray=array(
				'pid'=>$this->input->post('pid'),
				'name'=>$this->input->post('name'),
				'logo'=>$this->input->post('logo'),
				'thumb'=>$this->input->post('logo'),
				'intro'=>$this->input->post('intro'),
				'create_time'=>now()
			);//print_r($dataArray);exit;
			$result=$this->CircleModel->edit($dataArray,'id='.$id);
			if ($result){
				show_error('index.php/Circle/index',500,'提示信息：圈子修改成功！');
			}else{
				show_error('index.php/Circle/edit',500,'提示信息：圈子修改失败！');
			}
		}else{
			$id=$this->input->get('id');
			if ($id){
				$circle=$this->CircleModel->getModel('id='.$id);
				if ($circle){
					$parent=$this->CircleModel->getList('pid=0');
					$this->load->view('Circle/edit',array('circle'=>$circle,'parent'=>$parent));
				}else{
					show_error('index.php/Circle/index',500,'提示信息：你要修改的圈子不存在或者已被删除！');
				}
			}else{
				show_error('index.php/Circle/index',500,'提示信息：参数错误！');
			}
		}
	}
}
