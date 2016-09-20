<?php
class Content extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Mcontent');
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('url', 'common_helper'));
	}

	public function index(){
		# Check admin is logged
		if($this->session->userdata('admin_id')){
			# Get list contents

		} else redirect(base_url('admin/login'));
	}

	public function addContent(){
		# Check admin is logged
		if($this->session->userdata('admin_id')){
			# Check post request
			if($this->input->post('submit')){
				# Content data send by client
				$title = $this->input->post('title');
				$alias = $this->input->post('alias');
				$content = $this->input->post('content');
				$author = $this->session->userdata('admin_id');

				# Generate string for alias
				if(empty($alias)){
					$alias = $title;
				}
				# Remove unicode char
				$alias = stripunicode($alias);
				# Replace ' ' by '-'
				$alias = url_title($alias, '-', TRUE);

				# Upload image for thumbnail
				# File upload configuration
				$file_config['upload_path'] = './uploads/content/' ;
				$file_config['allowed_types'] = 'gif|jpg|jpeg|png';
				$file_config['max_size'] = '2048';
				
				# Initialize the upload class
				$this->load->library('upload', $file_config);

				if($this->upload->do_upload('thumbnail')){
					$file_data = $this->upload->data();
					$thumbnail = $file_data['file_name'];
				} else {
					$error = "Could not upload image. Please try again!"
					# Set default thumbnail value
					$thumnbail = 'no-image.gif';
				}
				if(!$this->Mcontent->duplicateAlias($alias)){
					if($this->Mcontent->addContent($title, $alias, $thumbnail, $content, $author))
						$data['success'] = ''
				}
			}

		} else redirect(base_url('admin/login'));
	}
}
?>