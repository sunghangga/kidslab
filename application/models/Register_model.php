<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register_model extends CI_Model
{

    public $table = 'register';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_count()
    {
      return $this->db->count_all_results($this->table);
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->select('r.*, c.id classroom_id, c.name class_name, ct.id class_type_id, ct.name class_type');
        $this->db->from('register r');
        $this->db->join('classroom c','c.id=r.classroom_id');
        $this->db->join('class_type ct','c.class_type_id=ct.id');
        $this->db->where('r.id', $id);
        return $this->db->get()->row();
    }

    // get data by id
    function get_by_id_regis_detail($id)
    {
        $this->db->select('id, register_id, num_box, box_name');
        $this->db->from('register_detail');
        $this->db->where('register_id', $id);
        return $this->db->get()->result();
    }

    // get data by id
    function get_book_by_id($id)
    {
        $this->db->select('r.*, ct.name class_type');
        $this->db->from('register r');
        $this->db->join('class_type ct','r.class_type_id=ct.id','left');
        $this->db->where('r.id', $id);
        return $this->db->get()->row();
    }

    // get data by id
    function get_data_register($class_type, $classroom, $date)
    {
        $this->db->select('r.*, c.name class_name, ct.name class_type');
        $this->db->from('register r');
        $this->db->join('classroom c','c.id=r.classroom_id');
        $this->db->join('class_type ct','c.class_type_id=ct.id');
        if ($class_type != null) {
            $this->db->where('ct.id', $class_type);
        }
        if ($classroom != null) {
            $this->db->where('c.id', $classroom);
        }
        // digunakan range tanggal 1 sampai 31 karena jumlah maks hari 31
        if ($date != null) { 
            $this->db->where('r.period >=', $date.'-01');
            $this->db->where('r.period <=', $date.'-31');
        }
        else {
            $this->db->where('r.period >=', date('Y-m').'-01');
            $this->db->where('r.period <=', date('Y-m').'-31');
        }
        return $this->db->get()->result();
    }

    // get data by id
    function get_data_reg_book()
    {
        $this->db->where('classroom_id IS NULL', null, false);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get_schedule
    function get_schedule($class_type, $classroom, $date)
    {
        $this->db->select('r.reg_code, r.child_name, r.parent_name, r.period, c.name class_name, ct.name class_type');
        $this->db->from('register r');
        $this->db->join('payment p','p.register_id=r.id');
        $this->db->join('classroom c','c.id=r.classroom_id');
        $this->db->join('class_type ct','c.class_type_id=ct.id');
        $this->db->where('p.pay_status', 1);
        if ($class_type != null) {
            $this->db->where('ct.id', $class_type);
        }
        if ($classroom != null) {
            $this->db->where('c.id', $classroom);
        }
        // digunakan range tanggal 1 sampai 31 karena jumlah maks hari 31
        if ($date != null) { 
            $this->db->where('r.period >=', $date.'-01');
            $this->db->where('r.period <=', $date.'-31');
        }
        else {
            $this->db->where('r.period >=', date('Y-m').'-01');
            $this->db->where('r.period <=', date('Y-m').'-31');
        }
        return $this->db->get()->result();
    }

    // get_address
    function get_address()
    {
        $this->db->select('r.reg_code, r.child_name, r.parent_name, r.period, r.address, r.email, r.phone, c.name class_name, ct.name class_type');
        $this->db->from('register r');
        $this->db->join('payment p','p.register_id=r.id');
        $this->db->join('classroom c','c.id=r.classroom_id');
        $this->db->join('class_type ct','c.class_type_id=ct.id');
        $this->db->where('p.pay_status', 1);
        return $this->db->get()->result();
    }

    // get_address
    function get_address_print($class_type, $classroom, $date, $ship_status)
    {
        $this->db->select('r.id reg_id, r.reg_code, r.child_name, r.parent_name, r.period, r.address, r.email, r.phone, c.name class_name, ct.name class_type, s.ship_status');
        $this->db->from('register r');
        $this->db->join('payment p','p.register_id=r.id');
        $this->db->join('shipment s','s.register_id=r.id');
        $this->db->join('classroom c','c.id=r.classroom_id');
        $this->db->join('class_type ct','c.class_type_id=ct.id');
        $this->db->where('p.pay_status', 1);
        // $this->db->where('s.ship_status', 1);
        if ($class_type != null) {
            $this->db->where('ct.id', $class_type);
        }
        if ($classroom != null) {
            $this->db->where('c.id', $classroom);
        }
        if ($ship_status != null) {
            $this->db->where('s.ship_status', $ship_status);
        }
        // digunakan range tanggal 1 sampai 31 karena jumlah maks hari 31
        if ($date != null) { 
            $this->db->where('r.period >=', $date.'-01');
            $this->db->where('r.period <=', $date.'-31');
        }
        else {
            $this->db->where('r.period >=', date('Y-m').'-01');
            $this->db->where('r.period <=', date('Y-m').'-31');
        }
        return $this->db->get()->result();
    }

    function get_per_address_print($id)
    {
        $this->db->select('r.reg_code, r.child_name, r.parent_name, r.period, r.address, r.email, r.phone, c.name class_name, ct.name class_type, s.ship_status');
        $this->db->from('register r');
        $this->db->join('payment p','p.register_id=r.id');
        $this->db->join('shipment s','s.register_id=r.id');
        $this->db->join('classroom c','c.id=r.classroom_id');
        $this->db->join('class_type ct','c.class_type_id=ct.id');
        $this->db->where('p.pay_status', 1);
        $this->db->where('r.id', $id);
        return $this->db->get()->result();
    }

    function get_last_code()
    {
        $this->db->select('max(reg_code) last_code');
        return $this->db->get($this->table)->row();
    }

    function search_participants($value)
    {
        $this->db->like('child_name', $value , 'both');
        $this->db->order_by('child_name', 'ASC');
        $this->db->limit(10);
        return $this->db->get('participants')->result();
    }

    function get_count_book($class_book_id, $period)
    {
        // format $period = 2020-07
        $this->db->select('count(reg_code) count');
        $this->db->where(array("classroom_id" => $class_book_id, "DATE_FORMAT(period,'%Y-%m')" => $period));
        return $this->db->get($this->table)->row();
    }

    function get_count_pay($class_book_id, $period)
    {
        // format $period = 2020-07
        $this->db->select('count(r.reg_code) count');
        $this->db->from('register r');
        $this->db->join('payment p','p.register_id=r.id');
        $this->db->where(array("p.pay_status" => 1, "r.classroom_id" => $class_book_id, "DATE_FORMAT(r.period,'%Y-%m')" => $period));
        return $this->db->get()->row();
    }

    function get_count_book_excel($class_book_id, $period)
    {
        // untuk memisahkan period
        $time = strtotime($period);
        $month = date("m",$time);
        $year = date("Y",$time);
        $period = $year.'-'.$month;
        $this->db->select('count(reg_code) count');
        $this->db->where(array("classroom_id" => $class_book_id, "DATE_FORMAT(period,'%Y-%m')" => $period));
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('reg_code', $q);
	$this->db->or_like('child_name', $q);
	$this->db->or_like('parent_name', $q);
	$this->db->or_like('phone', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('address', $q);
	$this->db->or_like('birth_date', $q);
	$this->db->or_like('period', $q);
	$this->db->or_like('class_type_id', $q);
	$this->db->or_like('classroom_id', $q);
	$this->db->or_like('note', $q);
	$this->db->or_like('create_at', $q);
	$this->db->or_like('update_at', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('reg_code', $q);
	$this->db->or_like('child_name', $q);
	$this->db->or_like('parent_name', $q);
	$this->db->or_like('phone', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('address', $q);
	$this->db->or_like('birth_date', $q);
	$this->db->or_like('period', $q);
	$this->db->or_like('class_type_id', $q);
	$this->db->or_like('classroom_id', $q);
	$this->db->or_like('note', $q);
	$this->db->or_like('create_at', $q);
	$this->db->or_like('update_at', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }

    // insert data detail
    function insert_detail($data)
    {
        $this->db->insert('register_detail', $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // update data detail
    function update_detail($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update('register_detail', $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Register_model.php */
/* Location: ./application/models/Register_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-24 00:42:02 */
/* http://harviacode.com */