<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Lecture extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('lecture_id');
        if ($id == '') {
            $kontak = $this->db->get('lecture')->result();
        } else {
            $this->db->where('lecture_id', $id);
            $kontak = $this->db->get('lecture')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post() {
        $data = array(
                    'matkul_code'    => $this->post('matkul_code'),
                    'class_code'          => $this->post('class_code'),
                    'dosen_code'    => $this->post('dosen_code'));
        $insert = $this->db->insert('lecture', $data);
        $id_lecture = $this->db->insert_id();
        $data2 = array(
                    'lecture_id'    => $id_lecture,
                    'class_code'          => $this->post('class_code'),
                    'dosen_code'    => $this->post('dosen_code'),
                    'start_day'    => $this->post('start_day'),
                    'start_hour'    => $this->post('start_hour'),
                    'end_hour'    => $this->post('end_hour'));
        $insert2 = $this->db->insert('lectureperiod', $data2);
        if ($insert2) {
            // $this->response($data, 200);
            header('Location: ' . $_SERVER['HTTP_REFERER'] .'?response=200');
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('lecture_id');
        $data = array(
                    'matkul_code'    => $this->put('matkul_code'),
                    'class_code'          => $this->put('class_code'),
                    'dosen_code'    => $this->put('dosen_code'));
        $this->db->where('lecture_id', $id);
        $update = $this->db->update('lecture', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete() {
        $id = $this->delete('lecture_id');
        $this->db->where('lecture_id', $id);
        $delete = $this->db->delete('lecture');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>
