<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Register_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $register = $this->Register_model->get_all();

        $data = array(
            'register_data' => $register
        );

        $this->template->load('template','register_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Register_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'reg_code' => $row->reg_code,
		'child_name' => $row->child_name,
		'parent_name' => $row->parent_name,
		'phone' => $row->phone,
		'email' => $row->email,
		'address' => $row->address,
		'birth_date' => $row->birth_date,
		'period' => $row->period,
		'class_type_id' => $row->class_type_id,
		'classroom_id' => $row->classroom_id,
		'note' => $row->note,
		'create_at' => $row->create_at,
		'update_at' => $row->update_at,
	    );
            $this->template->load('template','register_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('register'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('register/create_action'),
	    'id' => set_value('id'),
	    'reg_code' => set_value('reg_code'),
	    'child_name' => set_value('child_name'),
	    'parent_name' => set_value('parent_name'),
	    'phone' => set_value('phone'),
	    'email' => set_value('email'),
	    'address' => set_value('address'),
	    'birth_date' => set_value('birth_date'),
	    'period' => set_value('period'),
	    'class_type_id' => set_value('class_type_id'),
	    'classroom_id' => set_value('classroom_id'),
	    'note' => set_value('note'),
	    'create_at' => set_value('create_at'),
	    'update_at' => set_value('update_at'),
	);
        $this->template->load('template','register_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'reg_code' => $this->input->post('reg_code',TRUE),
		'child_name' => $this->input->post('child_name',TRUE),
		'parent_name' => $this->input->post('parent_name',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'email' => $this->input->post('email',TRUE),
		'address' => $this->input->post('address',TRUE),
		'birth_date' => $this->input->post('birth_date',TRUE),
		'period' => $this->input->post('period',TRUE),
		'class_type_id' => $this->input->post('class_type_id',TRUE),
		'classroom_id' => $this->input->post('classroom_id',TRUE),
		'note' => $this->input->post('note',TRUE),
		'create_at' => $this->input->post('create_at',TRUE),
		'update_at' => $this->input->post('update_at',TRUE),
	    );

            $this->Register_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('register'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Register_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('register/update_action'),
		'id' => set_value('id', $row->id),
		'reg_code' => set_value('reg_code', $row->reg_code),
		'child_name' => set_value('child_name', $row->child_name),
		'parent_name' => set_value('parent_name', $row->parent_name),
		'phone' => set_value('phone', $row->phone),
		'email' => set_value('email', $row->email),
		'address' => set_value('address', $row->address),
		'birth_date' => set_value('birth_date', $row->birth_date),
		'period' => set_value('period', $row->period),
		'class_type_id' => set_value('class_type_id', $row->class_type_id),
		'classroom_id' => set_value('classroom_id', $row->classroom_id),
		'note' => set_value('note', $row->note),
		'create_at' => set_value('create_at', $row->create_at),
		'update_at' => set_value('update_at', $row->update_at),
	    );
            $this->template->load('template','register_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('register'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'reg_code' => $this->input->post('reg_code',TRUE),
		'child_name' => $this->input->post('child_name',TRUE),
		'parent_name' => $this->input->post('parent_name',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'email' => $this->input->post('email',TRUE),
		'address' => $this->input->post('address',TRUE),
		'birth_date' => $this->input->post('birth_date',TRUE),
		'period' => $this->input->post('period',TRUE),
		'class_type_id' => $this->input->post('class_type_id',TRUE),
		'classroom_id' => $this->input->post('classroom_id',TRUE),
		'note' => $this->input->post('note',TRUE),
		'create_at' => $this->input->post('create_at',TRUE),
		'update_at' => $this->input->post('update_at',TRUE),
	    );

            $this->Register_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('register'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Register_model->get_by_id($id);

        if ($row) {
            $this->Register_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('register'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('register'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('reg_code', 'reg code', 'trim|required');
	$this->form_validation->set_rules('child_name', 'child name', 'trim|required');
	$this->form_validation->set_rules('parent_name', 'parent name', 'trim|required');
	$this->form_validation->set_rules('phone', 'phone', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('address', 'address', 'trim|required');
	$this->form_validation->set_rules('birth_date', 'birth date', 'trim|required');
	$this->form_validation->set_rules('period', 'period', 'trim|required');
	$this->form_validation->set_rules('class_type_id', 'class type id', 'trim|required');
	$this->form_validation->set_rules('classroom_id', 'classroom id', 'trim|required');
	$this->form_validation->set_rules('note', 'note', 'trim|required');
	$this->form_validation->set_rules('create_at', 'create at', 'trim|required');
	$this->form_validation->set_rules('update_at', 'update at', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Register.php */
/* Location: ./application/controllers/Register.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-24 00:42:02 */
/* http://harviacode.com */