<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Payment_model','Shipment_model'));
        $this->load->library('form_validation');
        if($this->session->userdata('user_login') != 'TRUE'){ redirect('login', 'refresh');}
    }

    public function index()
    {
        $payment = $this->Payment_model->get_all_join();

        $data = array(
            'payment_data' => $payment
        );

        $this->template->load('template','payment/payment_list', $data);
    }

    public function get_data_range()
    {
        $data = $this->Payment_model->get_all_join();
        echo json_encode($data);
    }

    public function read($id) 
    {
        $row = $this->Payment_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'pay_status' => $row->pay_status,
		'register_id' => $row->register_id,
		'create_at' => $row->create_at,
		'update_at' => $row->update_at,
	    );
            $this->template->load('template','payment/payment_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('payment'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('payment/create_action'),
	    'id' => set_value('id'),
	    'pay_status' => set_value('pay_status'),
	    'register_id' => set_value('register_id'),
	    'create_at' => set_value('create_at'),
	    'update_at' => set_value('update_at'),
	);
        $this->template->load('template','payment/payment_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'pay_status' => $this->input->post('pay_status',TRUE),
		'register_id' => $this->input->post('register_id',TRUE),
		'create_at' => $this->input->post('create_at',TRUE),
		'update_at' => $this->input->post('update_at',TRUE),
	    );

            $this->Payment_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('payment'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Payment_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('payment/update_action'),
		'id' => set_value('id', $row->id),
		'pay_status' => set_value('pay_status', $row->pay_status),
		'register_id' => set_value('register_id', $row->register_id),
		'create_at' => set_value('create_at', $row->create_at),
		'update_at' => set_value('update_at', $row->update_at),
	    );
            $this->template->load('template','payment/payment_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('payment'));
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
		'register_id' => $this->input->post('register_id',TRUE),
		'create_at' => $this->input->post('create_at',TRUE),
		'update_at' => $this->input->post('update_at',TRUE),
	    );

            $this->Payment_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('payment'));
        }
    }

    public function apply_payment() 
    {
        $id=$this->input->post('id', TRUE);
        $row = $this->Payment_model->get_by_id($id);
        if ($row->pay_status == 0) {
            $update_status = 1;
        }
        else {
            $update_status = 0;
        }
        $data = array(
            'pay_status' => $update_status,
            'update_at' => date('Y-m-d H:i:s'),
        );

        $this->Payment_model->update($id, $data, $row->register_id);
        $this->session->set_flashdata('message', 'Update Record Success');
        echo json_encode($data);
    }
    
    public function delete($id) 
    {
        $row = $this->Payment_model->get_by_id($id);

        if ($row) {
            $this->Payment_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('payment'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('payment'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('pay_status', 'pay status', 'trim|required');
	$this->form_validation->set_rules('register_id', 'register id', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Payment.php */
/* Location: ./application/controllers/Payment.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-24 16:56:46 */
/* http://harviacode.com */