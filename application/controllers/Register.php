<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Register_model','Participants_model','Class_type_model','Classroom_model'));
        $this->load->library('form_validation');
        if($this->session->userdata('user_login') != 'TRUE'){ redirect('login', 'refresh');}
    }

    public function index()
    {
        $register = $this->Register_model->get_all();

        $data = array(
            'register_data' => $register
        );

        $this->template->load('template','register/register_list', $data);
    }

    public function get_all_participants($id=null){
        if (isset($_GET['term'])) {
            $result = $this->Participants_model->get_all($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
              $arr_result[] = array(
              'child_name' => $row->child_name,
				'parent_name' => $row->parent_name,
				'phone' => $row->phone,
				'email' => $row->email,
				'address' => $row->address,
				'birth_date' => $row->birth_date,
            );
              echo json_encode($arr_result);
          }
        }
    }

    public function get_classroom_list($id=null){
      $data = $this->Classroom_model->get_classroom_by_type($id);
      echo json_encode($data);
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
            $this->template->load('template','register/register_read', $data);
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
	    'get_all_classtype' => $this->Class_type_model->get_all(),
	    'get_all_classroom' => $this->Classroom_model->get_all(),
	);
        $this->template->load('template','register/register_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
        	//untuk membuat kode otomatis
            $last_code = $this->Register_model->get_last_code();
            if (is_null($last_code->last_code)) {
                $last_code->last_code = 0;
            }
            $last_code = explode('.', $last_code->last_code);
            $code = (int) ($last_code[count($last_code)-1]);
            $code++;
            $branch = "KL21";
            $code = $branch.'.'.sprintf("%08s", $code);

            $data = array(
				'reg_code' => $code,
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
		    );

            $last_id = $this->Register_model->insert($data);

            $data_payment = array(
            	'register_id' => $last_id,
            	'pay_status' => 0, 
            );
            $this->Payment_model->insert($data_payment);
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
	    );
            $this->template->load('template','register/register_form', $data);
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
		'update_at' => date('Y-m-d H:i:s'),
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
	$this->form_validation->set_rules('child_name', 'child name', 'trim|required');
	$this->form_validation->set_rules('parent_name', 'parent name', 'trim|required');
	$this->form_validation->set_rules('phone', 'phone', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('address', 'address', 'trim|required');
	$this->form_validation->set_rules('birth_date', 'birth date', 'trim|required');
	$this->form_validation->set_rules('period', 'period', 'trim|required');
	$this->form_validation->set_rules('class_type_id', 'class type id', 'trim|required');
	$this->form_validation->set_rules('classroom_id', 'classroom id', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Register.php */
/* Location: ./application/controllers/Register.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-24 00:42:02 */
/* http://harviacode.com */