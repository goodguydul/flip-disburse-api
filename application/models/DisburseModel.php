<?php

class DisburseModel extends CI_Model{

  //BLANK FIELD REQUEST
  public function empty_response(){
    $response['status']   = 502;
    $response['error']    = true;
    $response['message']  = 'Field cannot blank';
    return $response;
  }

  //READ ALL DATA
  public function get_all_data(){

    $result               = $this->db->get_where("trx", array('status' => "PENDING"));

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

  //READ / GET DATA OF PENDING STATUS
  public function get_data($var){

    $result               = $this->db->get_where("trx", array('id' => $var, 'status' => "PENDING"));

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
}

?>
