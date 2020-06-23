<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Prodi extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('prodi_code');
        if ($id == '') {
            $kontak = $this->db->get('prodi')->result();
        } else {
            $this->db->where('prodi_code', $id);
            $kontak = $this->db->get('prodi')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post() {
        $data = array(
                    'prodi_code'           => $this->post('prodi_code'),
                    'prodi_name'          => $this->post('prodi_name'));
        $insert = $this->db->insert('prodi', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('prodi_code');
        $data = array(
                    'prodi_code'           => $this->put('prodi_code'),
                    'prodi_name'          => $this->put('prodi_name'));
        $this->db->where('prodi', $id);
        $update = $this->db->update('prodi', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete() {
        $id = $this->delete('prodi_code');
        $this->db->where('prodi_code', $id);
        $delete = $this->db->delete('prodi');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>
