<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('login');
	}

	public function login_act()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		// $cek = $this->db->query("SELECT * FROM login_data WHERE ld_email_address='$email' and ld_password = sha1('$password')")->row();

		// if($cek){
		// $id = $cek->ld_id;
		// $gdata = $this->db->query("SELECT * from personal_data where pd_ld_id = $id")->row();
		// 	$session = array(
		// 		'id' 		=> $cek->ld_id,
		// 		'email'		=> $cek->ld_email_address,
		// 		'nama'		=> $gdata->pd_full_name,
		// 		'status'	=> 'login'
		// 	);
		// 	$this->session->set_userdata($session);
		// 	$this->db->query("UPDATE login_data SET ld_last_login = NOW() where ld_id = $id");
		if($username == 'admin' && $password == 'admin'){
			$session = array(
					'nama'		=> $username,
					'status'	=> 'login'
				);
				$this->session->set_userdata($session);
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
