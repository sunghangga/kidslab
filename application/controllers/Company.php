<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Company extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Company_model');
        $this->load->library('form_validation');
        if($this->session->userdata('user_login') != 'TRUE'){ redirect('login', 'refresh');}
        if($this->session->userdata('user_level') != '1'){ redirect('login', 'refresh');}
    }

    public function index()
    {
        $company = $this->Company_model->get_all_company();

        $data = array(
            'company_data' => $company
        );

        $this->template->load('template','company/company_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Company_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'name' => $row->name,
		'logo' => $row->logo,
		'tlp' => $row->tlp,
        'update_at' => $row->update_at,
	    );
            $this->template->load('template','company/company_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('company'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('company/create_action'),
	    'id' => set_value('id'),
	    'name' => set_value('name'),
	    'logo' => set_value('logo'),
	    'tlp' => set_value('tlp'),
	);
        $this->template->load('template','company/company_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'logo' => $this->input->post('logo',TRUE),
		'tlp' => $this->input->post('tlp',TRUE),
	    );

            $this->Company_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('company'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Company_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('company/update_action'),
		'id' => set_value('id', $row->id),
		'name' => set_value('name', $row->name),
		'logo' => set_value('logo', $row->logo),
		'tlp' => set_value('tlp', $row->tlp),
	    );
            $this->template->load('template','company/company_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('company'));
        }
    }
    
    public function _updateImage()
    {
        $row = $this->Company_model->get_by_id($this->input->post('id', TRUE));

        $config['upload_path']          = './upload/logo/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = 'logo-'.date('ymd').'-'.substr(md5(rand()), 0, 10);
        $config['overwrite']            = true;
        $config['max_size']             = 2048;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('logo')) {
          $uploadData = $this->upload->data(); 
          return $uploadData['file_name'];
        }
        else{
            return $row->logo;
        }
    }

    public function update_action() 
    {
        $this->_rules();

        $row = $this->Company_model->get_by_id($this->input->post('id', TRUE));
        
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            if ($_FILES['logo']['size'] != 0) {
                if ($row->logo != "logo.png") {
                    $path = './upload/logo/'.$row->logo;
                    unlink($path);
                }
                $present_photo = $this->_updateImage();
            } else {
                $present_photo = $row->logo;
            }

              $data = array(
              'name' => $this->input->post('name',TRUE),
              'tlp' => $this->input->post('tlp',TRUE),
              'logo' => $present_photo,
              'update_at' => date('Y-m-d H:i:s'),
            );

          
            $this->Company_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('company'));
        }
        
    }
    
    public function delete($id) 
    {
        $row = $this->Company_model->get_by_id($id);

        if ($row->logo != "logo.png") {
            $path = './upload/logo/'.$row->logo;
            unlink($path);
        }

        if ($row) {
            $this->Company_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('company'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('company'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('tlp', 'tlp', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Company.php */
/* Location: ./application/controllers/Company.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-04-08 09:02:40 */
/* http://harviacode.com */