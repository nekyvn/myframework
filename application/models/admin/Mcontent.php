<?php
class Mcontent extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function addContent($title, $alias, $thumbnail, $content, $author){
		$data = array(
			'title' => $title,
			'alias' => $alias,
			'thumbnail' => $thumbnail,
			'content' => $content,
			'author' => $author
			);
		$this->db->set('date_post', 'NOW()', false);
		$this->db->set('date_modifie', 'NOW()', false);
		$this->db->insert('content', $data);
		if($this->db->affected_rows() > 0)
			return true;
		else return false;
	}

	public function editContent($id, $title, $alias, $thumbnail, $content, $date_post, $author){
		$data = array(
			'title' => $title,
			'alias' => $alias,
			'thumbnail' => $thumbnail,
			'content' => $content,
			'date_post' => $date_post,
			'author' => $author
			);
		$this->db->set('date_modifie', 'NOW()', false);
		$this->db->where('id', $id);
		$this->db->update('content', $data);
		if($this->db->affected_rows() > 0)
			return true;
		else return false;
	}

	public function ListContent($count, $offset){
		$query = $this->db->get('content', $count, $offset);
		if($query){
			$result = $query->result_array();
			return $result;
		} else return false;
	}

	public function getContent($id){
		$this->db->where('id', $id);
		$query = $this->db->get('content');
		if($query){
			$result = $query->row_array();
			return $result;
		} else return false;
	}

	public function deleteContent($id){
		$this->db->where('id', $id);
		$this->db->delete('content');
		if($this->db->affected_rows() > 0)
			return true;
		else return false;
	}

	public function duplicateAlias($alias, $id = null){
		if($id != null){
			$this->db->where('alias', $alias);
			$this->db->where('id !=', $id);
			$query = $this->db->get('content');
			if($query->num_rows() > 0)
				return true;
			else return false;
		} else {
			$this->db->where('alias', $alias);
			$query = $this->db->get('content');
			if($query->num_rows() > 0)
				return true;
			else return false;
		}
	}
}
?>