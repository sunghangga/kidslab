<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('User_model','Group_model'));
        $this->load->library('form_validation');
        if($this->session->userdata('user_login') != 'TRUE'){ redirect('login', 'refresh');}
    }

    public function index()
    {
      if($this->session->userdata('user_level') != '1'){ redirect('login', 'refresh');}
        $user = $this->User_model->get_all();

        $data = array(
            'user_data' => $user
        );

        $this->template->load('template','user/user_list', $data);
    }

    public function read($id) 
    {
      if($this->session->userdata('user_level') != '1'){ redirect('login', 'refresh');}
        $row = $this->User_model->get_by_id($id);
        if ($row) {
            $data = array(
        		'create_at' => $row->create_at,
        		'group_id' => $row->group_id,
        		'id' => $row->id,
        		'nama' => $row->name,
        		'password' => $row->password,
        		'update_at' => $row->update_at,
        		'username' => $row->username,
	    );
            $this->template->load('template','user/user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url().'user');
        }
    }

    public function create() 
    {
      if($this->session->userdata('user_level') != '1'){ redirect('login', 'refresh');}
        $data = array(
            'button' => 'Create',
            'action' => site_url('user/create_action'),
      	    'create_at' => set_value('create_at'),
      	    'get_all_group' => $this->Group_model->get_all(),
      	    'id' => set_value('id'),
            'group_id' => set_value('group_id'),
      	    'name' => set_value('name'),
      	    'password' => set_value('password'),
      	    'username' => set_value('username'),
	);
        $this->template->load('template','user/user_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        		'group_id' => $this->input->post('group_id',TRUE),
        		'name' => $this->input->post('name',TRUE),
            'password' => $this->bcrypt->hash_password($this->input->post('password'),TRUE),
        		'username' => $this->input->post('username',TRUE),
        	    );

            $this->User_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(base_url().'user');
        }
    }
    
    public function update($id) 
    {
      if($this->session->userdata('user_level') != '1'){ redirect('login', 'refresh');}
        $row = $this->User_model->get_by_id($id);
        $group = $this->Group_model->get_by_id($row->group_id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('user/update_action'),
      		'group_id' => set_value('group_id', $group->id),
          'group' => set_value('group_id', $group->name),
          'get_all_group' => $this->Group_model->get_all(),
      		'id' => set_value('id', $row->id),
      		'name' => set_value('name', $row->name),
      		'password' => set_value('password', $row->password),
      		'username' => set_value('username', $row->username),
      	    );
            $this->template->load('template','user/user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url().'user');
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
          $row = $this->User_model->get_by_id($this->input->post('id', TRUE));
          if($row->password!=$this->input->post('password')){
            $data = array(
            'group_id' => $this->input->post('group_id',TRUE),
            'name' => $this->input->post('name',TRUE),
            'password' => $this->bcrypt->hash_password($this->input->post('password'),TRUE),
            'update_at' => date('Y-m-d H:i:s'),
            'username' => $this->input->post('username',TRUE),
              );
            echo "tidak sama";
          }else{
              echo "sama";
            $data = array(
            'group_id' => $this->input->post('group_id',TRUE),
            'name' => $this->input->post('name',TRUE),
            'update_at' => date('Y-m-d H:i:s'),
            'username' => $this->input->post('username',TRUE),
              );
          }
            

            $this->User_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(base_url().'user');
        }
    }
    
    public function delete($id) 
    {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $this->User_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(base_url().'user');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url().'user');
        }
    }

    public function profil() 
    {
        $row = $this->User_model->get_by_id($this->session->userdata('user_id'));
        $group = $this->Group_model->get_by_id($row->group_id);
        if ($row) {
            $data = array(
              'button' => 'Update',
              'action' => site_url('user/profil_action'),
              'group_id' => set_value('group_id', $group->id),
              'group' => set_value('group_id', $group->name),
              'get_all_group' => $this->Group_model->get_all(),
              'id' => set_value('id', $row->id),
              'nama' => set_value('nama', $row->name),
              'password' => set_value('password', $row->password),
              'username' => set_value('username', $row->username),
                );
            $this->template->load('template','user/profil', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url().'beranda');
        }
    }

    public function profil_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->profil($this->input->post('id', TRUE));
        } else {
          $row = $this->User_model->get_by_id($this->input->post('id', TRUE));
          if($row->password!=$this->input->post('password')){
            $data = array(
            'group_id' => $this->input->post('group_id',TRUE),
            'nama' => $this->input->post('nama',TRUE),
            'password' => $this->bcrypt->hash_password($this->input->post('password'),TRUE),
            'update_at' => date('Y-m-d H:i:s'),
            'username' => $this->input->post('username',TRUE),
              );
          }else{
            $data = array(
            'group_id' => $this->input->post('group_id',TRUE),
            'nama' => $this->input->post('nama',TRUE),
            'update_at' => date('Y-m-d H:i:s'),
            'username' => $this->input->post('username',TRUE),
              );
          }
            

            $this->User_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(base_url().'beranda');
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('group_id', 'group id', 'trim');
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-02-22 02:24:38 */
/* http://harviacode.com */