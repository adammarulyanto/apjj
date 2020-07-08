<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Dosen extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('dosen_code');
        if ($id == '') {
            $kontak = $this->db->get('dosen')->result();
        } else {
            $this->db->where('dosen_code', $id);
            $kontak = $this->db->get('dosen')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post() {
        $dosen_code = $this->db->query("SELECT concat('D',max(SUBSTRING(dosen_code, 2, 5))+1) code from dosen")->row();
        $dosen_code = $dosen_code->code;
        $data = array(
                    'dosen_code'           => $dosen_code,
                    'dosen_firstname'          => $this->post('dosen_firstname'),
                    'dosen_lastname'    => $this->post('dosen_lastname'),
                    'dosen_birthdate'    => $this->post('dosen_birthdate'),
                    'dosen_email'    => $this->post('dosen_email'),
                    'dosen_password'    => sha1($this->post('dosen_password')));
        $insert = $this->db->insert('dosen', $data);
        if ($insert) {
            // $this->response($data, 200);
            header('Location: ' . $_SERVER['HTTP_REFERER'] .'?response=200');
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('dosen_code');
        $data = array(
                    'dosen_code'           => $this->put('dosen_code'),
                    'dosen_firstname'          => $this->put('dosen_firstname'),
                    'dosen_lastname'    => $this->put('dosen_lastname'),
                    'dosen_birthdate'    => $this->put('dosen_birthdate'),
                    'dosen_email'    => $this->put('dosen_email'),
                    'dosen_password'    => $this->put('dosen_password'));
        $this->db->where('dosen_code', $id);
        $update = $this->db->update('dosen', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete() {
        $id = $this->delete('dosen_code');
        $this->db->where('dosen_code', $id);
        $delete = $this->db->delete('dosen');
        if ($delete) {
            // $this->response(array('status' => 'success'), 201);
            header('Location: ' . $_SERVER['HTTP_REFERER'] .'?response=200');
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>
