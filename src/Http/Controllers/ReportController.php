<?php
  require_once 'src/Models/client/LegalModel.php';
  require_once 'src/Models/client/IndividualModel.php';
  require_once 'src/Models/PaymentScheduleModel.php';
  require_once 'src/UseCases/PaymentReportUseCase.php';
  
  class ReportController {
    public function paymentReport($req) {
      switch ($req->client->subject) {
        case 'legal':
          $chief = new Chief($req->client->chief);
          $address = new Address($req->client->org->address);
          $org = new Org($req->client->org, $address);
          $client = new LegalModel($req->client->subject, $chief, $org);
          break;
        case 'individual':
          $passport = new Passport($req->client->passport);
          $client = new IndividualModel($req->client, $passport);
          break;
      }
      $infoLoan = new PaymentScheduleModel($req->infoLoan);
      $schedule = (new PaymentScheduleUseCase($infoLoan))->monthlyPayments();
      $report = new PaymentReportUseCase($client, $schedule);
      echo $report->createReport();
      http_response_code(200);
      exit;
    }
  }
?>