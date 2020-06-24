<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class User_auth extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }
    function login_mhs(){
      $this->index_post();
    }
    function index_post(){
      // Get the post data
      $nim = $this->post('mhs_nim');
      $password = sha1($this->post('mhs_password'));

      // Validate the post data
      if(!empty($nim) && !empty($password)){

          // Check if any user exists with the given credentials
          $where = "mhs_nim =".$nim." and mhs_password ='".$password."'";
          $this->db->where($where, NULL, False);
          $user = $this->db->get('mhs')->result();
          $data = array(
                      'mhs_nim'           => $this->post('mhs_nim'),
                      'mhs_firstname'          => $this->post('mhs_firstname'),
                      'mhs_lastname'    => $this->post('mhs_lastname'),
                      'mhs_email'    => $this->post('mhs_email'));

          if($user){
              // Set the response and exit
              $this->response([
                  'status' => TRUE,
                  'message' => 'User login successful.',
                  'data' => $data
              ], REST_Controller::HTTP_OK);
          }else{
              // Set the response and exit
              //BAD_REQUEST (400) being the HTTP response code
              $this->response("Wrong email or password.", REST_Controller::HTTP_BAD_REQUEST);
          }
      }else{
          // Set the response and exit
          $this->response("Provide email and password.", REST_Controller::HTTP_BAD_REQUEST);
      }
    }
    function login_admin(){
      $this->admin_post();
    }
    function admin_post(){
      // Get the post data
      $nim = $this->post('mhs_nim');
      $password = sha1($this->post('mhs_password'));

      // Validate the post data
      if(!empty($nim) && !empty($password)){

          // Check if any user exists with the given credentials
          $where = "mhs_nim =".$nim." and mhs_password ='".$password."'";
          $this->db->where($where, NULL, False);
          $user = $this->db->get('mhs')->result();
          $data = array(
                      'mhs_nim'           => $this->post('mhs_nim'),
                      'mhs_firstname'          => $this->post('mhs_firstname'),
                      'mhs_lastname'    => $this->post('mhs_lastname'),
                      'mhs_email'    => $this->post('mhs_email'));

          if($user){
              // Set the response and exit
              $this->response([
                  'status' => TRUE,
                  'message' => 'User login successful.',
                  'data' => $data
              ], REST_Controller::HTTP_OK);
          }else{
              // Set the response and exit
              //BAD_REQUEST (400) being the HTTP response code
              $this->response("Wrong email or password.", REST_Controller::HTTP_BAD_REQUEST);
          }
      }else{
          // Set the response and exit
          $this->response("Provide email and password.", REST_Controller::HTTP_BAD_REQUEST);
      }
    }

}
?>
