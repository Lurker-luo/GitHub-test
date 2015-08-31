<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 主页模型
 * Enter description here ...
 * @author BenBen
 *
 */
class IndexNewsModel extends CI_Model {
	private $tableName='section';
	function __construct() {
		parent::__construct();
	}
	/**
	 * 添加
	 * Enter description here ...
	 * @param $dataArray
	 */
	function add($dataArray){
		$this->db->insert($this->tableName, $dataArray);
		return $this->db->insert_id();
	}
	/**
	 * 修改
	 * Enter description here ...
	 * @param $dataArray
	 * @param $where
	 */
	function edit($dataArray,$where){
		return $this->db->update($this->tableName, $dataArray,$where);
	}
	/**
	 * 删除
	 * Enter description here ...
	 * @param $strWhere
	 */
	function del($where){
		return $this->db->delete($this->tableName, $where);
	}
	/**
	 * 获取对象
	 * Enter description here ...
	 * @param unknown_type $where
	 */
	function getModel($where){
		$query=$this->db->where($where)->get($this->tableName);
		return $query->row_array();
	}
	/**
	 * 根据条件查询集合
	 * Enter description here ...
	 * @param $strWhere
	 */
	function getList($strWhere){
		$sql = "SELECT * FROM dx_".$this->tableName;
		if ($strWhere != '')
		$sql .= " WHERE " . $strWhere;
			
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	 * 分页函数
	 * Enter description here ...
	 * @param $pageSize
	 * @param $pageIndex
	 * @param $selParam 需要查询的内容
	 * @param $dataSet   查询的数据集
	 * @param $where
	 * @param $orderBy
	 */
	function getListByPage($pageSize,$pageIndex,$selParam,$dataSet,$strWhere,$orderBy){
		if ($selParam =='')
			$selParam= "*";
		if ($dataSet =='')
			$dataSet= "dx_".$this->tableName;
		$sql = "SELECT ".$selParam." FROM ".$dataSet;
		if ($strWhere != '')
			$sql .= " WHERE " . $strWhere;
		if ($orderBy != '')
			$sql .= " ORDER BY " . $orderBy;

		$sql .= " LIMIT " . ($pageSize * $pageIndex - $pageSize) . "," . $pageSize;  //print_r($sql);exit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/**
	 * 根据内连接条件获取数量
	 * Enter description here ...
	 * @param $database查找的数据集，可能为自连接查询，$strWhere查询的条件
	*/
	function getListCountByWhere($dataSet,$strWhere){
		if ($dataSet =='')
			$dataSet= "dx_".$this->tableName;
		$sql = "SELECT * FROM ".$dataSet;
		if ($strWhere != '')
			$sql .= " WHERE " . $strWhere;
			
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
}