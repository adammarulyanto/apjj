<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

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
		$data['list_kelas'] = $this->db->query('select c.class_code,c.class_program,c.class_guide,concat(dosen_firstname," ",dosen_lastname) dosen_name,prodi_name,count(*) jml_member,if(class_status="1","Active","Inactive") stat from classes c left join classmember cm on cm.class_code = c.class_code left join dosen on dosen_code = class_guide left join prodi on prodi_code = class_program group by class_code')->result();
		$data['list_prodi'] = $this->db->query('select prodi_code,prodi_name from prodi')->result();
		$data['list_dosen'] = $this->db->query('select dosen_code,concat(dosen_firstname," ",dosen_lastname) dosen_name from dosen')->result();
		$this->load->view('header');
		$this->load->view('kelas',$data);
		$this->load->view('footer');
	}
	function delete() {
			$id = $_GET['class_code'];

			$query = $this->db->query("UPDATE classes SET class_status=0 where class_code='".$id."'");
			if($query){
				header('Location: ' . $_SERVER['HTTP_REFERER'] .'?response=200');
			} else {
					$this->response(array('status' => 'fail', 502));
			}
	}
}
