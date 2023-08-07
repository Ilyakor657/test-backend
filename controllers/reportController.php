<?php
  require_once 'models/reportModel/paymentReport.php';
  require_once 'models/scheduleModel/paymentSchedule.php';
  
  class ReportController {
    public function paymentReport($req) {
      $schedule = new PaymentScheduleModel(
        $req->amount, 
        $req->period,
        $req->dateOpen,
        $req->rate
      );
      $paymentSchedule = $schedule->monthlyPayments();
      $report = new PaymentReportModel(
        $req->client,
        $paymentSchedule
      );
      echo $report->createReport();
      http_response_code(200);
      exit;
    }
  }
?>