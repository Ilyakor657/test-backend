<?php
  include_once 'models/scheduleModel/paymentSchedule.php';

  class ScheduleController {
    public function paymentSchedule($req) {
      $schedule = new PaymentScheduleModel(
        $req->amount, 
        $req->period,
        $req->dateOpen,
        $req->rate
      );
      echo $schedule->monthlyPayments();
      http_response_code(200);
      exit;
    }
  } 
?>