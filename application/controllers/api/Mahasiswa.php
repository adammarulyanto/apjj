<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Mahasiswa extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('mhs_id');
        if ($id == '') {
            $kontak = $this->db->get('mhs')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('mhs')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post() {
        $data = array(
                    'mhs_nim'           => $this->post('mhs_nim'),
                    'mhs_firstname'          => $this->post('mhs_firstname'),
                    'mhs_lastname'    => $this->post('mhs_lastname'),
                    'mhs_birthdate'    => $this->post('mhs_birthdate'),
                    'mhs_email'    => $this->post('mhs_email'),
                    'mhs_password'    => sha1($this->post('mhs_password')));
        $insert = $this->db->insert('mhs', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('mhs_nim');
        $data = array(
                    'mhs_nim'           => $this->put('mhs_nim'),
                    'mhs_firstname'          => $this->put('mhs_firstname'),
                    'mhs_lastname'    => $this->put('mhs_lastname'),
                    'mhs_birthdate'    => $this->put('mhs_birthdate'),
                    'mhs_email'    => $this->put('mhs_email'),
                    'mhs_password'    => $this->put('mhs_password'));
        $this->db->where('mhs_nim', $id);
        $update = $this->db->update('mhs', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete() {
        $id = $this->delete('mhs_nim');
        $this->db->where('mhs_nim', $id);
        $delete = $this->db->delete('mhs');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>
