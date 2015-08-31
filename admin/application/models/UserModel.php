<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 管理员模型
 * Enter description here ...
 * @author BenBen
 *
 */
class UserModel extends CI_Model {
	private $tableName='user';
	function __construct() {
		parent::__construct();
	}
	/**
	 * 登录函数
	 * Enter description here ...
	 * @param $username
	 * @param $password
	 */
	function login($username,$password){
		$data=array(
			'username'=>$username,
			'password'=>$password
		);
		$query=$this->db->where($data)->get($this->tableName);
		return $query->row_array();
	}
	/**
	 * 添加用户
	 * Enter description here ...
	 * @param $dataArray
	 */
	function addUser($dataArray){
		$this->db->insert($this->tableName, $dataArray);
		return $this->db->insert_id();
	}
	/**
	 * 修改管理员信息
	 * Enter description here ...
	 * @param $dataArray
	 * @param $where
	 */
	function editUser($dataArray,$where){
		return $this->db->update($this->tableName, $dataArray,$where);
	}
	/**
	 * 删除管理员
	 * Enter description here ...
	 * @param $strWhere
	 */
	function delUser($where){
		return $this->db->delete($this->tableName, $where);
	}
	/**
	 * 获取对象
	 * Enter description here ...
	 * @param unknown_type $where
	 */
	function getUser($where){
		$query=$this->db->where($where)->get($this->tableName);
		return $query->row_array();
	}
	/**
	 * 分页函数
	 * Enter description here ...
	 * @param $pageSize
	 * @param $pageIndex
	 * @param $where
	 * @param $orderBy
	 */
	function getUserByPage($pageSize,$pageIndex,$strWhere,$orderBy){
		$sql = "SELECT a.id,a.username,a.last_login_time,a.last_login_ip,b.name FROM dx_user a INNER JOIN dx_role b ON a.role_id=b.id ";
		if ($strWhere != '')
			$sql .= "WHERE " . $strWhere;
		if ($orderBy != '')
			$sql .= " ORDER BY " . $orderBy;

		$sql .= " LIMIT " . ($pageSize * $pageIndex - $pageSize) . "," . $pageSize;  //print_r($sql);exit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	 * 根据条件获取数量
	 * Enter description here ...
	 * @param $strWhere
	 */
	function getUserCountByWhere($strWhere){
		$sql = "SELECT a.id,a.username,a.last_login_time,a.last_login_ip,b.name FROM dx_user a INNER JOIN dx_role b ON a.role_id=b.id ";
		if ($strWhere != '')
			$sql .= "WHERE " . $strWhere;
			
		$query = $this->db->query($sql);
		return $query->num_rows(); 
	}
}