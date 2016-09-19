<?php
class mCommon extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function getConfigs(){
		$query = $this->db->get('site_configuration');
		if($query){
			$result = $query->row_array();
			return $result;
		} else return false;
	}

	public function getConfig($key){
		$query = $this->db->get_where('site_configuration', array('key' => $key));
		if($query){
			return $query->row_array();
		} else return false;
	}

	public function setConfig($key, $value){
		$data = array('value' => $value);
		$this->db->where('key' => $key);
		$this->db->update('site_configuration', $data);
		if($this->db->affected_rows() > 0)
			return true;
		else return false;
	}
}
?>