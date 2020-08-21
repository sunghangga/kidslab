<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Beranda extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Register_model','Participants_model','Class_type_model','Classroom_model','Payment_model','Shipment_model','Company_model'));
        if($this->session->userdata('user_login') != 'TRUE'){ redirect('login', 'refresh');}
    }

  
    function index(){
      $this->template->load('template','beranda');
    }

    public function get_count(){
      $data =
        array(
          'register'=> $this->Register_model->get_count(),
          'payment'=> $this->Payment_model->get_count(),
          'shipment'=> $this->Shipment_model->get_count(),
          'classroom'=> $this->Classroom_model->get_count(),
          'participants'=> $this->Participants_model->get_count(),
        );
      echo json_encode($data);
    }
}