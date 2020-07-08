<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index()
	{
		$this->load->view('login');
	}

	public function login_act()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$cek = $this->db->query("SELECT * FROM admins WHERE username='$username' and password = sha1('$password')")->row();

		if($cek){
		$id = $cek->admin_id;
		$gdata = $this->db->query("SELECT * from admins where admin_id = $id")->row();
			$session = array(
				'id' 		=> $cek->admin_id,
				'nama'		=> $cek->name,
				'status'	=> 'login'
			);
			$this->session->set_userdata($session);
			$this->db->query("UPDATE admins SET last_login = NOW() where admin_id = $id");
			redirect(base_url());
		}else{
			redirect(base_url()."login?alert=wrong");
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
