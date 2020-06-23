<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Attempt extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('attempt_id');
        if ($id == '') {
            $kontak = $this->db->get('attempt')->result();
        } else {
            $this->db->where('attempt_id', $id);
            $kontak = $this->db->get('attempt')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post() {
        $data = array(
                    'attempt_id'           => $this->post('attempt_id'),
                    'mhs_nim'          => $this->post('mhs_nim'),
                    'session_id'    => $this->post('session_id'),
                    'attempt_score'    => $this->post('attempt_score'));
        $insert = $this->db->insert('attempt', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('attempt_id');
        $data = array(
                    'attempt_id'           => $this->put('attempt_id'),
                    'mhs_nim'          => $this->put('mhs_nim'),
                    'session_id'    => $this->put('session_id'),
                    'attempt_score'    => $this->put('attempt_score'));
        $this->db->where('attempt_id', $id);
        $update = $this->db->update('attempt', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete() {
        $id = $this->delete('attempt_id');
        $this->db->where('attempt_id', $id);
        $delete = $this->db->delete('attempt');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>
