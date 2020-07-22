<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Beranda extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('user_login') != 'TRUE'){ redirect('login', 'refresh');}
    }

  
    function index(){
      $this->template->load('template','beranda');
    }
}