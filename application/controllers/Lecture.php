<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lecture extends CI_Controller {

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
		$data['list_kelas'] = $this->db->query('select * from classes')->result();
		$data['list_lecture'] = $this->db->query("select lectureperiod_id,lp.lecture_id,lp.class_code,lp.dosen_code,concat(dosen_firstname,'',dosen_lastname) dosen_name,l.matkul_code,matkul_name,matkul_sks,case start_day when 1 then 'Senin' when 2 then 'Selasa' when 3 then 'Rabu' when 4 then 'Kamis' when 5 then 'Jumat' when 6 then 'Sabtu' when 7 then 'Minggu' end start_day,start_hour,end_hour,if(lecture_status='1','Active','Inactive') stat from lectureperiod lp left join lecture l on l.lecture_id = lp.lecture_id left join classes c on c.class_code = lp.class_code left join dosen d on d.dosen_code = lp.dosen_code left join matkul m on m.matkul_code = l.matkul_code")->result();
		$data['list_dosen'] = $this->db->query('select dosen_code,concat(dosen_firstname," ",dosen_lastname) dosen_name from dosen')->result();
		$data['list_matkul'] = $this->db->query('select matkul_code,matkul_name from matkul')->result();
		$this->load->view('header');
		$this->load->view('lecture',$data);
		$this->load->view('footer');
	}

	function delete() {
			$id = $_GET['lecture_id'];

			$query = $this->db->query("UPDATE lecture set lecture_status=0 where lecture_id='".$id."'");
			if($query){
				header('Location: ' . $_SERVER['HTTP_REFERER'] .'?response=200');
			} else {
					$this->response(array('status' => 'fail', 502));
			}
	}
}
