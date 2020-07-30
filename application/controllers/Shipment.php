<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shipment extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Shipment_model','Class_type_model','Classroom_model'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = array(
            'get_all_classtype' => $this->Class_type_model->get_all(),
            'get_all_classroom' => $this->Classroom_model->get_all()
        );

        $this->template->load('template','shipment/shipment_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Shipment_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'pay_status' => $row->pay_status,
		'ship_status' => $row->ship_status,
		'register_id' => $row->register_id,
		'create_at' => $row->create_at,
		'update_at' => $row->update_at,
	    );
            $this->template->load('template','shipment/shipment_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('shipment'));
        }
    }

    public function get_data_range()
    {
        $class_type = $_GET['class_type'];
        $classroom = $_GET['classroom'];
        $date = $_GET['date'];
        $data = $this->Shipment_model->get_all_join($class_type, $classroom, $date);
        echo json_encode($data);
    }

    public function apply_shipment() 
    {
        $id=$this->input->post('id');
        $row = $this->Shipment_model->get_by_id($id);
        if ($row->ship_status == 0) {
            $update_status = 1;
        }
        else {
            $update_status = 0;
        }
        $data = array(
            'ship_status' => $update_status,
            'update_at' => date('Y-m-d H:i:s'),
        );

        $data = $this->Shipment_model->update($id, $data);
        $this->session->set_flashdata('message', 'Update Record Success');
        echo json_encode($data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('shipment/create_action'),
	    'id' => set_value('id'),
	    'pay_status' => set_value('pay_status'),
	    'ship_status' => set_value('ship_status'),
	    'register_id' => set_value('register_id'),
	    'create_at' => set_value('create_at'),
	    'update_at' => set_value('update_at'),
	);
        $this->template->load('template','shipment/shipment_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'pay_status' => $this->input->post('pay_status',TRUE),
		'ship_status' => $this->input->post('ship_status',TRUE),
		'register_id' => $this->input->post('register_id',TRUE),
		'create_at' => $this->input->post('create_at',TRUE),
		'update_at' => $this->input->post('update_at',TRUE),
	    );

            $this->Shipment_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('shipment'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Shipment_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('shipment/update_action'),
		'id' => set_value('id', $row->id),
		'pay_status' => set_value('pay_status', $row->pay_status),
		'ship_status' => set_value('ship_status', $row->ship_status),
		'register_id' => set_value('register_id', $row->register_id),
		'create_at' => set_value('create_at', $row->create_at),
		'update_at' => set_value('update_at', $row->update_at),
	    );
            $this->template->load('template','shipment/shipment_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('shipment'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'pay_status' => $this->input->post('pay_status',TRUE),
		'ship_status' => $this->input->post('ship_status',TRUE),
		'register_id' => $this->input->post('register_id',TRUE),
		'create_at' => $this->input->post('create_at',TRUE),
		'update_at' => $this->input->post('update_at',TRUE),
	    );

            $this->Shipment_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('shipment'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Shipment_model->get_by_id($id);

        if ($row) {
            $this->Shipment_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('shipment'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('shipment'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('ship_status', 'ship status', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Shipment.php */
/* Location: ./application/controllers/Shipment.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-26 07:51:07 */
/* http://harviacode.com */