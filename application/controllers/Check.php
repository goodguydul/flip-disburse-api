<?php

class Check extends CI_Controller{

  public function __construct(){

    parent::__construct();

    $this->load->model('ApiModel');
  }

  //CREATE
  public function updatedData(){

    $response = $this->ApiModel->add_data(
      $this->post('bank_code'),
      $this->post('account_number'),
      $this->post('amount'),
      $this->post('remark')
    );

    $this->response($response);
  }
}

?>
