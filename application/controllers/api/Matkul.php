<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Matkul extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('matkul_code');
        if ($id == '') {
            $kontak = $this->db->get('matkul')->result();
        } else {
            $this->db->where('matkul_code', $id);
            $kontak = $this->db->get('matkul')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post() {
        $matkul_code = $this->db->query("SELECT ifnull(concat('MK',max(SUBSTRING(matkul_code, 3, 5))+1),'MK1') code from matkul")->row();
        $matkul_code = $matkul_code->code;
        $data = array(
                    'matkul_code'           => $matkul_code,
                    'matkul_name'          => $this->post('matkul_name'),
                    'matkul_sks'    => $this->post('matkul_sks'));
        $insert = $this->db->insert('matkul', $data);
        if ($insert) {
            // $this->response($data, 200);
            header('Location: ' . $_SERVER['HTTP_REFERER'] .'?response=200');
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('matkul_code');
        $data = array(
                    'matkul_code'           => $this->put('matkul_code'),
                    'matkul_name'          => $this->put('matkul_name'),
                    'matkul_sks'    => $this->put('matkul_sks'));
        $this->db->where('matkul_code', $id);
        $update = $this->db->update('matkul', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete() {
        $id = $this->delete('matkul_code');
        $this->db->where('matkul_code', $id);
        $delete = $this->db->delete('matkul');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>
