<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

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
		$data['list_mhs'] = $this->db->query('select *,if(mhs_status="1","Active","Inactive") stat from mhs')->result();
		$this->load->view('header');
		$this->load->view('mahasiswa',$data);
		$this->load->view('footer');
	}
	function delete() {
			$id = $_GET['mhs_nim'];

			$query = $this->db->query("UPDATE mhs SET mhs_status=0 where mhs_nim='".$id."'");
			if($query){
				header('Location: ' . $_SERVER['HTTP_REFERER'] .'?response=200');
			} else {
					$this->response(array('status' => 'fail', 502));
			}
	}
}
