<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 管理员模型
 * Enter description here ...
 * @author BenBen
 *
 */
class AccessModel extends CI_Model {
	private $tableName='access';
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * 获取对象
	 * Enter description here ...
	 * @param unknown_type $where
	 */
	function getAccess($where){
		$query=$this->db->where($where)->get($this->tableName);
		return $query->row_array();
	}
	/**
	 * 删除现有权限
	 * Enter description here ...
	 * @param $strWhere
	 */
	function delAccess($where){
		return $this->db->delete($this->tableName, $where);
	}
	/**
	 * 配置权限
	 * Enter description here ...
	 * @param $dataArray
	 */
	function addAccess($dataArray){
		return $this->db->insert($this->tableName, $dataArray);
	}
	/**
	 * 查询集合
	 * Enter description here ...
	 * @param $strWhere
	 */
	function getListByWhere($strWhere){
		$sql = "SELECT * FROM dx_".$this->tableName." ";
		if ($strWhere != '')
			$sql .= "WHERE " . $strWhere;
		
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}