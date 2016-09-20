<?php
class Admin extends CI_Controller{	
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/Madmin');
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
				$id_admin = $this->Madmin->getLogin($username, $password);
				if($login_info){
					$this->session->set_userdata('admin_id', $login_info);
					$this->Madmin->updateLogin($login_info, $_SERVER['REMOTE_ADDR']);
					redirect('admin/index');
				} else $this->session->set_flashdata('msg', "Login Failed - Check Your Login Info");
			}
			$this->load->view('admintpl/admin/login', $data);
		} else {
			#redirect(base_url('admin/index'));
		}
	}

	public function forgotpassword(){
		if(!$this->session->userdata('admin_id')){
			if($this->input->post('email')){
				$email = $this->input->post('email');
				# Check if email avaiable in the database
				$admin_info = $this->Madmin->getAdminByEmail($email);

				echo $email;
				if($admin_info){
					# Create random string for new password
					$randomPassword = random_string('alnum', 20);
					# Update new password to database
					if($this->Madmin->editAdmin($admin_info['id'], $admin_info['username'], $randomPassword, $admin_info['email'], $admin_info['fullname'], $admin_info['address'])){
						# Mail configuration
						$mail_config['protocol'] = 'smtp';
						$mail_config['smtp_host'] = 'ssl://smtp.googlemail.com';
						$mail_config['smtp_user'] = 'baby.cyrax';
						$mail_config['smtp_pass'] = 'thegioikotinhyeu';
						$mail_config['port'] = 465;
						$mail_config['mailtype'] = 'html';
  						$mail_config['charset'] = 'utf-8';
  						$mail_config['wordwrap'] = TRUE;
						$this->email->initialize($mail_config);
						$this->email->from('baby.cyrax@gmail.com', 'Trung Nguyen');
						$this->email->to($email);
						$this->email->subject('Password Reset!');
						$message = "Your password has been reset to " . $randomPassword;
						$this->email->message($message);
						if($this->email->send())
							$this->session->set_flashdata('success', "Your password updated. Check email for your new password");
						else {
							$this->session->set_flashdata('error', "Can't send mail. Please try again!");
						}
					}
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