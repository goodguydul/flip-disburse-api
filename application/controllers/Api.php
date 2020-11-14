<?php

require APPPATH . 'libraries/REST_Controller.php';

class Api extends REST_Controller{

  public function __construct(){

    parent::__construct();

    $this->load->model('ApiModel');
  }

  //CREATE
  public function add_post(){

    $response = $this->ApiModel->add_data(
        $this->post('bank_code'),
        $this->post('account_number'),
        $this->post('amount'),
        $this->post('remark')
      );

    $this->response($response);
  }

  //READ
  public function index_get(){
    $id = $this->get('id');

    if ($id === NULL) {
      $response = $this->ApiModel->all_data();
      $this->response($response);

    }else{
      $response = $this->ApiModel->select_data($id);
      $this->response($response);
    }
  }

  //UPDATE
  public function update_put(){
    $response = $this->ApiModel->update_data(
      $this->put('id'),
      $this->put('status'),
      $this->put('receipt'),
      $this->put('time_served')
    );
    $this->response($response);
  }

  //DELETE
  public function delete_delete(){
    $response = $this->ApiModel->delete_data(
        $this->delete('id')
      );
    $this->response($response);
  }
}

?>
