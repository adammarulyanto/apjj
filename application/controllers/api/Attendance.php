<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Attendance extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('attendance_id');
        if ($id == '') {
            $kontak = $this->db->get('attendance')->result();
        } else {
            $this->db->where('attendance_id', $id);
            $kontak = $this->db->get('attendance')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post() {
        $data = array(
                    'attendance_id'           => $this->post('attendance_id'),
                    'session_id'          => $this->post('session_id'),
                    'mhs_nim'    => $this->post('mhs_nim'),
                    'attended'    => $this->post('attended'));
        $insert = $this->db->insert('attendance', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('attendance_id');
        $data = array(
                    'attendance_id'           => $this->put('attendance_id'),
                    'session_id'          => $this->put('session_id'),
                    'mhs_nim'    => $this->put('mhs_nim'),
                    'attended'    => $this->put('attended'));
        $this->db->where('attendance_id', $id);
        $update = $this->db->update('attendance', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete() {
        $id = $this->delete('attendance_id');
        $this->db->where('attendance_id', $id);
        $delete = $this->db->delete('attendance');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>
