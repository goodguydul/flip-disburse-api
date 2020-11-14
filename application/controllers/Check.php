<?php

class Check extends CI_Controller{

  //action to check all data status in database when triggered 
  //this controller need to be set on a CronJob, so the checker can check and update the data automaticly.


  public function action(){

    $this->load->library('disburse');
    $this->load->model('DisburseModel');
    $trx_data = $this->DisburseModel->get_all_data();

    if (isset($trx_data['data'])){

      $trx_data = $trx_data['data'];

      foreach ($trx_data as $trx) {

        $disburse_data = $this->disburse->CheckIfDataIsUpdated($trx->id);

        if ($disburse_data['status'] === "SUCCESS") {
          $this->DisburseModel->update_data($trx->id, $disburse_data['status'], $disburse_data['receipt'], $disburse_data['time_served']); 
          echo $trx->id . " is updated<br>";
        } 
        // sleep(0.05);
      }
    }
  }
}
?>
