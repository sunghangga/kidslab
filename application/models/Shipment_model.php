<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shipment_model extends CI_Model
{

    public $table = 'shipment';
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

    // get all join
    function get_all_join()
    {
        $this->db->select('s.id, s.pay_status, s.ship_status, s.create_at, s.update_at, r.reg_code, r.child_name, r.parent_name, r.phone, r.email');
        $this->db->from('shipment s');
        $this->db->join('register r','r.id=s.register_id');
        $this->db->where('s.pay_status',1);
        $this->db->order_by('s.id', $this->order);
        return $this->db->get()->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('pay_status', $q);
	$this->db->or_like('ship_status', $q);
	$this->db->or_like('register_id', $q);
	$this->db->or_like('create_at', $q);
	$this->db->or_like('update_at', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('pay_status', $q);
	$this->db->or_like('ship_status', $q);
	$this->db->or_like('register_id', $q);
	$this->db->or_like('create_at', $q);
	$this->db->or_like('update_at', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // update data by register_id
    function update_by_register_id($id, $data)
    {
        $this->db->where('register_id', $data->register_id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Shipment_model.php */
/* Location: ./application/models/Shipment_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-26 07:51:07 */
/* http://harviacode.com */