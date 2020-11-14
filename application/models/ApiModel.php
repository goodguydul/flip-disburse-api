<?php

use GuzzleHttp\Client;

// extends class Model
class ApiModel extends CI_Model{

  private $client;
  private $auth;    

  public function __construct(){
    parent::__construct();

    $this->auth = [config_item('FLIP_API_KEY'),''];

    $this->client = new Client([
      'base_uri'  => config_item('FLIP_API_URL'),
      'auth'      => $this->auth
    ]);
  }

  private function SendDisburse($bank_code, $account_number, $amount, $remark){
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

  //BLANK FIELD REQUEST
  public function empty_response(){
    $response['status']   = 502;
    $response['error']    = true;
    $response['message']  = 'Field cannot blank';
    return $response;
  }

  //CREATE
  public function add_data($bank_code, $account_number, $amount, $remark){

    if(empty($bank_code) || empty($account_number) || empty($amount) || empty($remark)){

      return $this->empty_response();

    }else{
      $data = array(
        "bank_code"       => $bank_code,
        "account_number"  => $account_number,
        "amount"          => $amount,
        "remark"          => $remark,
      );

      $flip_api_response   = $this->SendDisburse($bank_code, $account_number, $amount, $remark);

      $insert = $this->db->insert("trx", $flip_api_response);

      if($insert){
        $response['status']   = 200;
        $response['error']    = false;
        $response['message']  = 'Data added successfully';

        return $response;

      }else{
        $response['status']   = 409;
        $response['error']    = true;
        $response['message']  ='Failed to insert new data';

        return $response;
      }
    }

  }

  //READ ALL
  public function all_data(){

    $result               = $this->db->get("trx")->result();
    $response['status']   = 200;
    $response['error']    = false;
    $response['data']     = $result;

    return $response;

  }

  public function select_data($var){

    $result               = $this->db->get_where("trx", array('id' => $var));

    if ($result->num_rows() > 0){
      $response['status'] = 200;
      $response['error']  = false;
      $response['data']   = $result->result();

    }else{
      $response['status'] = 404;
      $response['error']  = true;
      $response['message']= "Data not found";
    }

    return $response;
  }

  // UPDATE
  public function update_data($id, $status, $receipt, $time_served){

    if(empty($id) || empty($status) || empty($receipt) || empty($time_served)){

      return $this->empty_response();

    }else{
      $where = array(
        "id" => $id
      );

      $set = array(
        "status"      => $status,
        "receipt"     => $receipt,
        "time_served" => $time_served
      );

      $this->db->where($where);

      $update = $this->db->update("trx", $set);

      if($update){

        $response['status']   = 200;
        $response['error']    = false;
        $response['message']  = 'Data updated successfully';

        return $response;

      }else{
        $response['status']   = 409;
        $response['error']    = true;
        $response['message']  = 'Data update failed';

        return $response;

      }
    }
  }

  //DELETE DATA
  public function delete_data($id){

    if($id == ''){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $this->db->where($where);
      $delete = $this->db->delete("trx");

      if($delete){
        $response['status']   = 200;
        $response['error']    = false;
        $response['message']  = 'Data deleted successfully';

        return $response;

      }else{
        $response['status']   = 409;
        $response['error']    = true;
        $response['message']  ='Failed to delete data';

        return $response;

      }
    }

  }

}

?>
