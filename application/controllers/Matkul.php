<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matkul extends CI_Controller {

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
		$data['list_matkul'] = $this->db->query('select *,if(matkul_status="1","Active","Inactive") stat from matkul')->result();
		$this->load->view('header');
		$this->load->view('matkul',$data);
		$this->load->view('footer');
	}
	function delete() {
			$id = $_GET['matkul_code'];

			$query = $this->db->query("UPDATE matkul SET matkul_status=0 where matkul_code='".$id."'");
			if($query){
				header('Location: ' . $_SERVER['HTTP_REFERER'] .'?response=200');
			} else {
					$this->response(array('status' => 'fail', 502));
			}
	}
}
