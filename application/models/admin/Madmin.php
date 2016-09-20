<?php
class Madmin extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	# Get Admin Info For Login
	public function getLogin($username, $password){
		$query = $this->db->get_where('administrator', array('username' => $username, 'password' => $password));
		if($query)
		{
			$result = $query->row_array();
			return $result['id'];
		} else return false;
	}

	# Add new admin account to database
	public function addNewAdmin($username, $password, $email, $fullname, $address){
		$data = array(
				'username' => $username,
				'password' => $password,
				'email' => $email,
				'fullname' => $fullname,
				'address' => $address,
			);
		$this->db->insert('administrator', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	# Update admin info
	public function editAdmin($id, $username, $password, $email, $fullname, $address){
		$data = array(
				'username' => $username,
				'password' => $password,
				'email' => $email,
				'fullname' => $fullname,
				'address' => $address,
			);
		$this->db->where('id', $id);
		$this->db->update('administrator', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function deleteAdmin($id){
		$this->db->where('id', $id);
		$this->db->delete('administrator');
		return ($this->db->affected_rows() <= 0) ? false : true;
	}
	
	public function getInfo($id){
		$query = $this->db->get_where('administrator', array('id' => $id));
		if($query){
			$result = $query->row_array();
			return $result;
		} else {
			return false;
		}
	}

	public function getAdminByEmail($email){
		$query = $this->db->get_where('administrator', array('email' => $email));
		if($query){
			$result = $query->row_array();
			return $result;
		} else return false;
	}

	public function getAdminByUsername($username){
		$query = $this->db->get_where('administrator', array('username' => $username));
		if($query){
			$result = $query->row_array();
			return $result;
		} else return false;
	}

	public function getAdminById($id){
		$query = $this->db->get_where('administrator', array('id' => $id));
		if($query){
			$result = $query->row_array();
			return $result;
		} else return false;
	}

	public function updateLastLogin($id, $ip){
		$data = array('ip' => $id);
		$this->db->set('last_time_login', 'NOW()', false);
		$this->db->where('id', $id);
		$this->db->update('administrator');
		if($this->db->affected_rows() != 0)
			return true;
		else return false;
	}
}
?>