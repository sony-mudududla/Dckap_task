<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct()
    {
    parent::__construct();

    $this->load->library('cart');
    $this->load->model('cart_model');
    }

    public function index()
    {

        $data['products'] = $this->cart_model->get_all();
		//print_r($data); exit;

        $this->load->view('welcome_message',$data);
    }



    function add()
    {

    $insert_data = array(
                'id' => $this->input->post('id'),
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'image' => $this->input->post('image'),
                'qty' => 1
                );

    $this->cart->insert($insert_data);
    echo $fefe = count($this->cart->contents());

    }

    


    function remove() {
    $rowid = $this->input->post('rowid');

    if ($rowid==="all"){

        $this->cart->destroy();
    }else{

    $data = array(
            'rowid' => $rowid,
            'qty' => 0
            );

    $this->cart->update($data);
    }
    echo $fefe = count($this->cart->contents());
   
    }




    function update_cart(){
    $rowid = $_POST['rowid'];
    $price = $_POST['price'];
    $amount = $price * $_POST['qty'];
    $qty = $_POST['qty'];

    $data = array(
        'rowid' => $rowid,
        'price' => $price,
        'amount' => $amount,
        'qty' => $qty
        );
    $this->cart->update($data);
    echo $data['amount'];
    }

    function checkout(){

    $this->load->view('checkout');
    }

    public function save_order()
    {
 
    $customer = array(
        'name' => $this->input->post('name'),
        'email' => $this->input->post('email'),
        'address' => $this->input->post('address'),
        'phone' => $this->input->post('phone')
        );

    $cust_id = $this->cart_model->insert_customer($customer);
    $order = array(
        'date' => date('Y-m-d'),
        'customerid' => $cust_id
        );
    $ord_id = $this->cart_model->insert_order($order);
    if ($cart = $this->cart->contents()){
    foreach ($cart as $item){
    $order_detail = array(
        'orderid' => $ord_id,
        'productid' => $item['id'],
        'quantity' => $item['qty'],
        'price' => $item['price']
        );

		$cust_id = $this->cart_model->insert_order_detail($order_detail);
        }
    }
    $this->cart->destroy();
   
    $this->load->view('success');
    }



    public function opencart()
    {
        $data['cart']  = $this->cart->contents();
        $this->load->view("cart", $data);
    }





    }