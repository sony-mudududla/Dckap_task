<?php
class Cart_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all(){
        $query=$this->db->query("SELECT p.* FROM products p ");
        return $query->result_array();
    }

    public function insert_customer($data)
    {
        $this->db->insert('customers', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }

    public function insert_order($data)
    {
        $this->db->insert('orders', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }

    public function insert_order_detail($data)
    {
        $this->db->insert('order_detail', $data);
    }




}