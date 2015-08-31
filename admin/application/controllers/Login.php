<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	/**
	 * 构造函数
	 * Enter description here ...
	 */
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->login();
	}
	/**
	 * 登录
	 * Enter description here ...
	 */
	public function login()
	{
		$cmd=$this->input->post('cmd');
		if ($cmd&&$cmd=='submit'){
			$username=$this->input->post('username');
			$password=$this->input->post('password');
			$passcode=$this->input->post('passcode');
			if ($passcode==$this->session->userdata('code')){
				$this->load->model('UserModel','',TRUE);
				$result=$this->UserModel->login($username,md5($password));
				if ($result){//登录成功
					if ($result['status']=='1'){
						//更新登录状态
						$this->UserModel->editUser(array('last_login_time'=>now(),'last_login_ip'=>$this->input->ip_address()),array('id'=>$result['id']));
						$this->session->set_userdata('user', $result);//保存登录状态
						show_error('index.php/Index/index',500,'提示信息：登录成功！');
					}else{
						show_error('index.php/Login/login',500,'提示信息：您已被禁止登录，请联系超级管理员！');
					}
				}else{
					show_error('index.php/Login/login',500,'提示信息：用户名或者密码错误！');
				}
			}else{
				show_error('index.php/Login/login',500,'提示信息：验证码输入错误！');
			}
		}else{
			$this->session->unset_userdata('user');
			$this->load->view('login');
		}
	}

	/**
	 * 生成验证码
	 * Enter description here ...
	 */
	function create_Code(){
		$_vc = new ValidateCode();		//实例化一个对象
		$_vc->doimg();
		$this->session->set_userdata('code', $_vc->getCode());//验证码保存到SESSION中
	}
}
