<?php

class ApiModel extends CI_Model{

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

      // DISBURSE 
      $this->load->library('disburse');
      $disburse_response   = $this->disburse->SendDisburse($bank_code, $account_number, $amount, $remark);

      //STORE TO DATABASE
      $insert = $this->db->insert("trx", $disburse_response);

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

  //READ BY ID
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
  public function update_data($id, $data){

    //assumed $data is an array of data that want to update.

    if(empty($id) || empty($data)){

      return $this->empty_response();

    }else{
      $where = array(
        "id" => $id
      );

      $this->db->where($where);

      $update = $this->db->update("trx", $data);

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
