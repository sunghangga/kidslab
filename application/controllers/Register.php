<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Register extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Register_model','Participants_model','Class_type_model','Classroom_model','Payment_model','Shipment_model'));
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

    public function get_data_range()
    {
        $register = $this->Register_model->get_data_register();
        echo json_encode($register);
    }

    public function schedule()
    {
        $this->template->load('template','schedule/schedule_list');
    }

    public function schedule_list()
    {
        $schedule = $this->Register_model->get_schedule();
        echo json_encode($schedule);
    }

    public function schedule_report()
    {
        $this->template->load('template','report/schedule_by_period');
    }

    public function address_list()
    {
    	$address = $this->Register_model->get_address();
        echo json_encode($address);
    }

    public function address_report()
    {
        $this->template->load('template','report/address_by_period');
    }

    public function get_all_participants($id=null){
        if (isset($_GET['term'])) {
            $result = $this->Register_model->search_participants($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
              $arr_result[] = array(
              	'code' => $row->code,
              	'label' => $row->child_name, //harus pake variabel label biar kebaca
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
	    // 'class_type_id' => set_value('class_type_id'),
	    // 'classroom_id' => set_value('classroom_id'),
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
        	// untuk mengecek jumlah kelas tersisa
        	$class_book_id = $this->input->post('classroom_id',TRUE);
	        $period = $this->input->post('period',TRUE);
	        $check_quota = $this->Classroom_model->get_by_id($class_book_id);
	        $count_book_class = $this->Register_model->get_count_book($class_book_id, $period);

	        if ($count_book_class->count >= $check_quota->quota) {
	        	$this->form_validation->set_rules('quota_limit', 'quota_limit', 'trim|required',
	        		array('required' => 
	        			'<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  <strong><i class="icon fas fa-ban"></i>Alert!</strong> Quota for the selected class is full. Choose another class, or upgrade quota.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>')
	        	);
	        	$this->form_validation->run();
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
					'period' => $this->input->post('period',TRUE).'-01', //untuk dapat masuk ke db
					'class_type_id' => $this->input->post('class_type_id',TRUE),
					'classroom_id' => $this->input->post('classroom_id',TRUE),
					'note' => $this->input->post('note',TRUE),
			    );

	            $last_id = $this->Register_model->insert($data);

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
	            redirect(site_url('register'));
	        }
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
				'class_type_name' => set_value('class_type_name', $row->class_type),
				'classroom_name' => set_value('classroom_name', $row->class_name),
				'note' => set_value('note', $row->note),
				'get_all_classtype' => $this->Class_type_model->get_all(),
			    'get_all_classroom' => $this->Classroom_model->get_all(),
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
        	// untuk mengecek jumlah kelas tersisa
        	$class_book_id = $this->input->post('classroom_id',TRUE);
	        $period = $this->input->post('period',TRUE);
	        $check_quota = $this->Classroom_model->get_by_id($class_book_id);
	        $count_book_class = $this->Register_model->get_count_book($class_book_id, $period);

	        if ($count_book_class->count >= $check_quota->quota) {
	        	$this->form_validation->set_rules('quota_limit', 'quota_limit', 'trim|required',
	        		array('required' => 
	        			'<div class="alert alert-danger alert-dismissible">
                  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  				<h5><i class="icon fas fa-ban"></i> Alert!</h5>
                  				Quota for the selected class is full. Choose another class, or upgrade quota
                  		</div>')
	        	);
	        	$this->form_validation->run();
	        	$this->update($this->input->post('id', TRUE));
	        } else {
	            $data = array(
					'child_name' => $this->input->post('child_name',TRUE),
					'parent_name' => $this->input->post('parent_name',TRUE),
					'phone' => $this->input->post('phone',TRUE),
					'email' => $this->input->post('email',TRUE),
					'address' => $this->input->post('address',TRUE),
					'birth_date' => $this->input->post('birth_date',TRUE),
					'period' => $this->input->post('period',TRUE).'-01',
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
    }

    public function schedule_excel()
    {
    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet
		->setCellValue('A1', 'No')
		->setCellValue('B1', 'Registration Code')
		->setCellValue('C1', 'Child Name')
		->setCellValue('D1', 'Period')
		->setCellValue('E1', 'Class Type')
		->setCellValue('F1', 'Classroom');
        
        $schedule = $this->Register_model->get_schedule();
        $i=2; //row ke berapa
        foreach($schedule as $data) {
        	// untuk memisahkan period
        	$time=strtotime($data->period);
			$month=date("F",$time);
			$year=date("Y",$time);
			
			$sheet
			->setCellValue('A'.$i, $i-1)
			->setCellValue('B'.$i, $data->reg_code)
			->setCellValue('C'.$i, $data->child_name)
			->setCellValue('D'.$i, $month.' '.$year)
			->setCellValue('E'.$i, $data->class_type)
			->setCellValue('F'.$i, $data->class_name);
			$i++;
		}

		$writer = new Xlsx($spreadsheet);
		
		$filename = 'Schedule - '.date('F Y');
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}
    
    public function delete() 
    {
    	$id=$this->input->post('id', TRUE);
        $row = $this->Register_model->get_by_id($id);

        if ($row) {
            $this->Register_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            echo json_encode($row);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            echo json_encode($row);
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