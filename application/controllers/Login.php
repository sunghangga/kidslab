<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    function index()
    {
            if($this->session->userdata('user_logedin') == TRUE)
            {
                //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
                //redirect("beranda");

              redirect(base_url().'beranda');
			}else{

				//jika session belum terdaftar

				//set form validation
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');

				//set message form validation
				$this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
					<div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

				//cek validasi
				if ($this->form_validation->run() == TRUE) {

				//get data dari FORM
					$username = $this->input->post("username", TRUE);
					$password =  $this->input->post('password', TRUE);

					//checking data via model
					$checking = $this->User_model->get_by_username($username);

					if($this->User_model->exist_row_check('user','username',$username)>0){
						//jika ditemukan, maka create session
						if ($this->bcrypt->check_password($password, $checking->password) ) {
							if($checking->status == "1"){
								$session_data = array(
									'user_id'           => $checking->id,
									'user_nama'     	=> $checking->name,
									'user_level'        => $checking->group_id,
									'user_login'      => TRUE,
								);
								//set session userdata
								$this->session->set_userdata($session_data);
								redirect(base_url().'beranda');
							}else{
								$data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
								<div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> Maaf anda tidak memiliki akses </div></div>';
							$this->load->view('login', $data);
							}

						}else{
							$data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
								<div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> username atau password salah!</div></div>';
							$this->load->view('login', $data);
						}

					}else{
						$data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
								<div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> Maaf Username belum terdaftar!</div></div>';
							$this->load->view('login', $data);
					}

					
				}else{
					$this->load->view('login');
				}
			}


        }

      

    function logout(){
    	
		$this->session->sess_destroy();
    redirect(base_url().'login');

    } 

 }  

?>