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
        $this->load->model(array('Register_model','Participants_model','Class_type_model','Classroom_model','Payment_model','Shipment_model','Company_model'));
        $this->load->library('form_validation');
        if($this->session->userdata('user_login') != 'TRUE'){ redirect('login', 'refresh');}
    }

    public function index()
    {
        $register = $this->Register_model->get_all();

        $data = array(
            'register_data' => $register,
            'get_all_classtype' => $this->Class_type_model->get_all(),
            'get_all_classroom' => $this->Classroom_model->get_all()
        );

        $this->template->load('template','register/register_list', $data);
    }

    public function get_data_range()
    {
    	$class_type = $_GET['class_type'];
        $classroom = $_GET['classroom'];
        $date = $_GET['date'];
        $register = $this->Register_model->get_data_register($class_type, $classroom, $date);
        echo json_encode($register);
    }

    public function get_data_reg_book()
    {
        $register = $this->Register_model->get_data_reg_book();
        echo json_encode($register);
    }

    public function schedule()
    {
    	$data = array(
            'get_all_classtype' => $this->Class_type_model->get_all(),
            'get_all_classroom' => $this->Classroom_model->get_all()
        );
        $this->template->load('template','schedule/schedule_list', $data);
    }

    public function schedule_list()
    {
    	$class_type = $_GET['class_type'];
        $classroom = $_GET['classroom'];
        $date = $_GET['date'];
        $schedule = $this->Register_model->get_schedule($class_type, $classroom, $date);
        echo json_encode($schedule);
    }

    public function schedule_report()
    {
    	$data = array(
            'get_all_classtype' => $this->Class_type_model->get_all(),
            'get_all_classroom' => $this->Classroom_model->get_all()
        );
        $this->template->load('template','report/schedule_by_period', $data);
    }

    public function address_list()
    {
    	$class_type = $_GET['class_type'];
        $classroom = $_GET['classroom'];
        $date = $_GET['date'];
    	$address = $this->Register_model->get_address_print($class_type, $classroom, $date);
        echo json_encode($address);
    }

    public function address_report()
    {
    	$data = array(
            'get_all_classtype' => $this->Class_type_model->get_all(),
            'get_all_classroom' => $this->Classroom_model->get_all()
        );
        $this->template->load('template','report/address_by_period', $data);
    }

    public function address_pdf()
    {
    	if ($_GET['ct'] != null) {
    		$class_type =  $_GET['ct'];
    	}
    	else {
    		$class_type = null;
    	}
    	if ($_GET['c'] != null) {
    		$classroom =  $_GET['c'];
    	}
    	else {
    		$classroom = null;
    	}
    	if ($_GET['d'] != null) {
    		$date =  $_GET['d'];
    	}
    	else {
    		$date = null;
    	}
    	
    	$company = $this->Company_model->get_all();
        $row = $this->Register_model->get_address_print($class_type, $classroom, $date);
        if ($row) {
            $data = array(
	            'logo' => $company->logo,
	            'name' => $company->name,
	            'tlp' => $company->tlp,
	            'data_address' => $row
	        );
            $this->load->library("mypdf");
            set_time_limit(500);
            $this->mypdf->generate("report/address_print","A4","potrait","Participants Address", $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('register/address_report'));
        }
    }

    public function get_all_participants($id=null){
        if (isset($_GET['term'])) {
            $result = $this->Register_model->search_participants($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
              $arr_result[] = array(
              	'code' => $row->code,
              	'label' => $row->child_name.' ('.$row->code.')', //harus pake variabel label biar kebaca
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

    public function read_book($id) 
    {
        $row = $this->Register_model->get_book_by_id($id);
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
				'class_type_id' => $row->class_type,
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

    public function update_book($id) 
    {
        $row = $this->Register_model->get_book_by_id($id);

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
        
        if ($_GET['ct'] != null) {
    		$class_type =  $_GET['ct'];
    	}
    	else {
    		$class_type = null;
    	}
    	if ($_GET['c'] != null) {
    		$classroom =  $_GET['c'];
    	}
    	else {
    		$classroom = null;
    	}
    	if ($_GET['d'] != null) {
    		$date =  $_GET['d'];
    	}
    	else {
    		$date = null;
    	}

        $schedule = $this->Register_model->get_schedule($class_type, $classroom, $date);
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
		
		$filename = 'Schedule Period '.$month.' - '.$year;
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function import_excel(){
		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		
		if(isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
			$arr_file = explode('.', $_FILES['upload_file']['name']);
			$extension = end($arr_file);
			if('csv' == $extension){
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();

			// $data = array();
			// $data_participants = array();
			for($i = 1;$i < count($sheetData);$i++)
			{
				if ($sheetData[$i][6] == 'ALPHA') {
					$class_type = $this->Class_type_model->get_id_class_type($sheetData[$i][6]);
					$classroom = $this->Classroom_model->get_id_classroom($sheetData[$i][7]);
				}
				elseif ($sheetData[$i][6] == 'BETA'){ //bila class_type = BETA
					$class_type = $this->Class_type_model->get_id_class_type($sheetData[$i][6]);
					$classroom = $this->Classroom_model->get_id_classroom($sheetData[$i][8]);
				}

				// jika class yang dipilih custom
				if ($classroom->id == null) {
					if ($sheetData[$i][6] == 'ALPHA') {
						$note = $sheetData[$i][7].' (Request)';
					}
					elseif ($sheetData[$i][6] == 'BETA'){
						$note = $sheetData[$i][8].' (Request)';
					}
				}
				// jika class yang dipilih sudah penuh 
				elseif ($classroom->id != null) {
					// untuk mengecek jumlah kelas tersisa
			        $check_quota = $this->Classroom_model->get_by_id($classroom->id);
			        $count_book_class = $this->Register_model->get_count_book_excel($classroom->id, $sheetData[$i][9]);
			        //$sheetData[$i][9] adalah period
			        if ($count_book_class->count >= $check_quota->quota) {
			        	if ($sheetData[$i][6] == 'ALPHA') {
							$note = $sheetData[$i][7].' (Class Full)';
						}
						elseif ($sheetData[$i][6] == 'BETA'){
							$note = $sheetData[$i][8].' (Class Full)';
						}
						$classroom->id = null;
			        }
				}

				// array untuk insert register
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
                	'parent_name' => $sheetData[$i][1],
                	'address' => $sheetData[$i][2],
                	'phone' => $sheetData[$i][3],
                    'child_name' => $sheetData[$i][4],
                    'birth_date' => $sheetData[$i][5],
                    'class_type_id' => $class_type->id,
                    'classroom_id' => $classroom->id,
                    'email' => 'default@email.com',
                    'note' => $note,
                    'period' => $sheetData[$i][9], //dalam format 2020-07-28
            	);
            	$last_id = $this->Register_model->insert($data);

            	// untuk cek apa ada data regis yang diinput pada participants
	            $check_participants = $this->Participants_model->get_count_participants($sheetData[$i][4], $sheetData[$i][3]);
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
		        		'child_name' => $sheetData[$i][4],
		        		'parent_name' => $sheetData[$i][1],
		        		'phone' => $sheetData[$i][3],
		        		'email' => 'default@email.com',
		        		'address' => $sheetData[$i][2],
		        		'birth_date' => $sheetData[$i][5],
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
            }

			print_r($data);
			$this->session->set_flashdata('message', 'Update Record Success');
	        redirect(site_url('register'));
		}
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

    public function delete_book() 
    {
    	$id=$this->input->post('id', TRUE);
        $row = $this->Register_model->get_book_by_id($id);

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