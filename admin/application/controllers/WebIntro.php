<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class WebIntro extends My_Controller {
	/**
	 * 构造函数
	 * Enter description here ...
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('WebIntroModel');
		$this->load->library('Page');
	}
	/**
	 * 默认函数
	 * Enter description here ...
	 */
	public function index(){
		$pageSize=5;
		$pageIndex=$this->input->get('page')?$this->input->get('page'):1;
		$sel_param="a.section_name as asection_name,b.*";
		$data_set="dx_section a INNER JOIN dx_section b ON a.id = b.pid";
		$strWhere="a.id = 2 and b.grade = 3";
		$orderBy='';
		$totalCount=$this->WebIntroModel->getListCountByWhere($data_set,$strWhere);
		$WebIntro=$this->WebIntroModel->getListByPage($pageSize,$pageIndex,$sel_param,$data_set,$strWhere,$orderBy);
		$page=new Page();
		$str_page=$page->create($pageIndex, $pageSize, $totalCount, array(), array());
		$data=array(
			'page'=>$str_page,
			'WebIntro'=>$WebIntro
		);
		$this->load->view('WebIntro/list',$data);
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
			$result=$this->WebIntroModel->add($dataArray);
			if ($result){
				show_error('index.php/WebIntro/index',500,'提示信息：新闻信息添加成功！');
			}else{
				show_error('index.php/WebIntro/add',500,'提示信息：新闻信息添加失败！');
			}
		}else{
			$parent=$this->WebIntroModel->getList( " pid=1 and  grade = 2 ");
			$this->load->view('WebIntro/add',array('parent'=>$parent));
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
			$result=$this->WebIntroModel->edit($dataArray,'id='.$id);
			if ($result){
				show_error('index.php/WebIntro/index',500,'提示信息：网站简介修改成功！');
				echo "信息修改成功！";
			}else{
				show_error('index.php/WebIntro/edit',500,'提示信息：网站简介修改失败！');
			}
		}else{
			$selParam="";
			$dataSet="dx_section a INNER JOIN dx_section b ON a.id = b.pid";
			$strWhere="a.id = 2 and b.grade = 3";
			$orderBy='';
			$query=$this->WebIntroModel->getListByJoin($selParam,$dataSet,$strWhere,$orderBy);
			$id= $query['id'];//单页栏目,选择最新的函数
			if ($id){
				$WebIntro=$this->WebIntroModel->getModel('id='.$id);
				if ($WebIntro){
					$parent=$this->WebIntroModel->getList('id = 2');
					$this->load->view('WebIntro/edit',array('WebIntro'=>$WebIntro,'parent'=>$parent));
				}else{
					show_error('index.php/WebIntro/index',500,'提示信息：你要修改的网站简介不存在或者已被删除！');
				}
			}else{
				show_error('index.php/WebIntro/index',500,'提示信息：参数错误！');
			}
		}
	}
}