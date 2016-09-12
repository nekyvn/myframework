<?php
class admin extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/admin_model');
		$this->load->library(array('form_validation', 'email', 'session'));
		$this->load->helper(array('url', 'string'));
	}

	public function login(){
		if(!($this->session->userdata('admin_id'))){
			$data = array();
			if($this->input->post('submit'))
			{
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$id_admin = $this->admin_model->getLogin($username, $password);
				if($login_info){
					$this->session->set_userdata('admin_id', $login_info);
					$this->admin_model->updateLogin($login_info, )
					redirect('admin/index');
				} else $this->session->set_flashdata('msg', "Login Failed - Check Your Login Info");
			}
			$this->load->view('admintpl/admin/login', $data);
		} else {
			redirect(base_url('admin/index'));
		}
	}

	public function forgotpassword(){
		if(!$this->session->userdata('admin_id')){
			if($this->input->post('submit')){
				$email = $this->input->post('email');
				
				# Check if email avaiable in the database
				$admin_info = $this->admin_model->getAdminByEmail($email);
				if($admin_info){
					# Create random string for new password
					$randomPassword = random_string('alnum', 20);
					# Update new password to database
					if($this->admin_model->editAdmin($admin_info['id'], $admin_info['username'], $randomPassword, $admin_info['email'], $admin_info['fullname'], $admin_info['address']))
							$this->session->set_flashdata('success', "Your password updated. Check email for your new password");
						else $this->session->set_flashdata('error', "Can't update your password. Please try again!");
				} else $this->session->set_flashdata('error', "Can't find your email in database. Try another one!");
			}
			$this->load->view('admintpl/admin/forgotpassword');
		} else {
			redirect('admin/index');
		}
	}

	public function index(){
		if($this->session->userdata('admin_id')){
			# Get page view

			# Get Comment

			# Get Category
		} else redirect('admin/login');
	}
}
?>