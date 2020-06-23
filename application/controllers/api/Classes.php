<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Classes extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('class_code');
        if ($id == '') {
            $kontak = $this->db->get('classes')->result();
        } else {
            $this->db->where('class_code', $id);
            $kontak = $this->db->get('classes')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post() {
        $data = array(
                    'class_code'           => $this->post('class_code'),
                    'class_program'          => $this->post('class_program'),
                    'class_guide'    => $this->post('class_guide'));
        $insert = $this->db->insert('classes', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('class_code');
        $data = array(
                    'class_code'           => $this->put('class_code'),
                    'class_program'          => $this->put('class_program'),
                    'class_guide'    => $this->put('class_guide'));
        $this->db->where('classes', $id);
        $update = $this->db->update('classes', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_delete() {
        $id = $this->delete('class_code');
        $this->db->where('class_code', $id);
        $delete = $this->db->delete('classes');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>
