<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Participants extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Participants_model');
        $this->load->library('form_validation');
        if($this->session->userdata('user_login') != 'TRUE'){ redirect('login', 'refresh');}
    }

    public function index()
    {
        $participants = $this->Participants_model->get_all();

        $data = array(
            'participants_data' => $participants
        );

        $this->template->load('template','participants/participants_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Participants_model->get_by_id($id);
        if ($row) {
            $data = array(
    		'id' => $row->id,
    		'code' => $row->code,
    		'child_name' => $row->child_name,
    		'parent_name' => $row->parent_name,
    		'phone' => $row->phone,
    		'email' => $row->email,
    		'address' => $row->address,
    		'birth_date' => $row->birth_date,
    		'create_at' => $row->create_at,
    		'update_at' => $row->update_at,
    	    );
            $this->template->load('template','participants/participants_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('participants'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('participants/create_action'),
	    'id' => set_value('id'),
	    'child_name' => set_value('child_name'),
	    'parent_name' => set_value('parent_name'),
	    'phone' => set_value('phone'),
	    'email' => set_value('email'),
	    'address' => set_value('address'),
	    'birth_date' => set_value('birth_date'),
	);
        $this->template->load('template','participants/participants_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            //untuk membuat kode otomatis
            $last_code = $this->Participants_model->get_last_code();
            if (is_null($last_code->last_code)) {
                $last_code->last_code = 0;
            }
            $last_code = explode('.', $last_code->last_code);
            $code = (int) ($last_code[count($last_code)-1]);
            $code++;
            $branch = "KL11";
            $code = $branch.'.'.sprintf("%06s", $code);

            $data = array(
    		'code' => $code,
    		'child_name' => $this->input->post('child_name',TRUE),
    		'parent_name' => $this->input->post('parent_name',TRUE),
    		'phone' => $this->input->post('phone',TRUE),
    		'email' => $this->input->post('email',TRUE),
    		'address' => $this->input->post('address',TRUE),
    		'birth_date' => $this->input->post('birth_date',TRUE),
	    );

            $this->Participants_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('participants'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Participants_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('participants/update_action'),
        		'id' => set_value('id', $row->id),
        		'child_name' => set_value('child_name', $row->child_name),
        		'parent_name' => set_value('parent_name', $row->parent_name),
        		'phone' => set_value('phone', $row->phone),
        		'email' => set_value('email', $row->email),
        		'address' => set_value('address', $row->address),
        		'birth_date' => set_value('birth_date', $row->birth_date),
	    );
            $this->template->load('template','participants/participants_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('participants'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
    		'child_name' => $this->input->post('child_name',TRUE),
    		'parent_name' => $this->input->post('parent_name',TRUE),
    		'phone' => $this->input->post('phone',TRUE),
    		'email' => $this->input->post('email',TRUE),
    		'address' => $this->input->post('address',TRUE),
    		'birth_date' => $this->input->post('birth_date',TRUE),
    		'update_at' => date('Y-m-d H:i:s'),
	    );

            $this->Participants_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('participants'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Participants_model->get_by_id($id);

        if ($row) {
            $this->Participants_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('participants'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('participants'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('child_name', 'child name', 'trim|required');
	$this->form_validation->set_rules('parent_name', 'parent name', 'trim|required');
	$this->form_validation->set_rules('phone', 'phone', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('address', 'address', 'trim|required');
	$this->form_validation->set_rules('birth_date', 'birth date', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Participants.php */
/* Location: ./application/controllers/Participants.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-24 00:41:54 */
/* http://harviacode.com */