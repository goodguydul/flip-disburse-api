<?php

use GuzzleHttp\Client;

class Disburse extends CI_Controller{

  private $_CI;
  private $client;
  private $auth;    

  public function __construct(){

    $this->_CI = & get_instance();
    $this->_CI->load->model('DisburseModel','dm');

    $this->auth = [config_item('FLIP_API_KEY'),''];
    $this->client = new Client([
      'base_uri'  => config_item('FLIP_API_URL'),
      'auth'      => $this->auth
    ]);
  }

  public function SendDisburse($bank_code, $account_number, $amount, $remark){
    $data = [
      'form_params' => [
          'bank_code' => $bank_code,
          'account_number' => $account_number,
          'amount'  => $amount,
          'remark'  => $remark
      ]
    ];

    $response = $this->client->request('POST', 'disburse', $data);

    $result   = json_decode($response->getBody()->getContents(), true);

    return $result;
  }

  public function CheckIsDataUpdated($id){

  }
}

?>
