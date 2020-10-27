<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Register_model','Participants_model','Class_type_model','Classroom_model','Payment_model','Shipment_model','Company_model'));
        $this->load->library('form_validation');
        if($this->session->userdata('user_login') != 'TRUE'){ redirect('login', 'refresh');}
    }

    public function index()
    {
        $data = array(
            'get_all_classtype' => $this->Class_type_model->get_all(),
            'get_all_classroom' => $this->Classroom_model->get_all()
        );

        $this->template->load('template','payment/payment_list', $data);
    }

    public function get_data_range()
    {
        $class_type = $_GET['class_type'];
        $classroom = $_GET['classroom'];
        $pay_status = $_GET['pay_status'];
        $date = $_GET['date'];
        $data = $this->Payment_model->get_all_join($class_type, $classroom, $date, $pay_status);
        echo json_encode($data);
    }

    public function subscribe() 
    {
        $id = $this->input->post('id', TRUE);
        $date = $this->input->post('date', TRUE);
        $row = $this->Register_model->get_by_id($id);
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
            'child_name' => $row->child_name,
            'parent_name' => $row->parent_name,
            'phone' => $row->phone,
            'email' => $row->email,
            'address' => $row->address,
            'birth_date' => $row->birth_date,
            'period' => $date.'-01', //untuk dapat masuk ke db
            'class_type_id' => $row->class_type_id,
            'classroom_id' => $row->classroom_id,
            'note' => $row->note,
        );
        // untuk mendapatkan last id register
        $last_id = $this->Register_model->insert($data);

        // untuk cek apa ada data regis yang diinput pada participants
        $check_participants = $this->Participants_model->get_count_participants($data['child_name'], $data['phone']);
        if ($check_participants->count <= 0) {
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

            $data_participants = array(
                'code' => $code,
                'child_name' => $data['child_name'],
                'parent_name' => $data['parent_name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'address' => $data['address'],
                'birth_date' => $data['birth_date'],
            );
            $this->Participants_model->insert($data_participants);
        }

        $data_payment = array(
            'register_id' => $last_id,
            'pay_status' => 0, 
        );

        $data_shipment = array(
            'register_id' => $last_id,
            'pay_status' => 0,
            'ship_status' => 0, 
        );

        $this->Payment_model->insert($data_payment);
        $this->Shipment_model->insert($data_shipment);
        $this->session->set_flashdata('message', 'Create Record Success');
        redirect(site_url('payment'));
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
        // untuk mengetahui id register
        $id=$this->input->post('id', TRUE);
        // $id=575;
        $row = $this->Payment_model->get_by_id($id);
        $data_reg = $this->Register_model->get_by_id($row->register_id);
        
        // untuk mengecek jumlah kelas tersisa
        $class_book_id = $data_reg->classroom_id;
        $period = date_format(new DateTime($data_reg->period),'Y-m'); //dalam format YYYY-MM
        $check_quota = $this->Classroom_model->get_by_id($class_book_id);
        $count_fix_class = $this->Register_model->get_count_pay($class_book_id, $period);

        if ($count_fix_class->count >= $check_quota->quota && $row->pay_status == 0) {
            $data_back = array(
                'status' => false,
                'remain' => $check_quota->quota - $count_fix_class->count,
                'class_name' => $data_reg->class_name,
                'class_type' => $data_reg->class_type,
            );
            echo json_encode($data_back);
        } else {
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

            // untuk mengecek jumlah kelas tersisa
            $class_book_id = $data_reg->classroom_id;
            $period = date_format(new DateTime($data_reg->period),'Y-m'); //dalam format YYYY-MM
            $check_quota = $this->Classroom_model->get_by_id($class_book_id);
            $count_fix_class = $this->Register_model->get_count_pay($class_book_id, $period);
            
            $data_back = array(
                'status' => true,
                'remain' => $check_quota->quota - $count_fix_class->count,
                'class_name' => $data_reg->class_name,
                'class_type' => $data_reg->class_type,
            );

            $this->session->set_flashdata('message', 'Update Record Success');
            echo json_encode($data_back);
        }
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