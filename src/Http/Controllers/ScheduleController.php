<?php
  require_once 'src/Models/PaymentScheduleModel.php';
  require_once 'src/UseCases/PaymentScheduleUseCase.php';
  require_once 'src/Mappers/Mapper.php';

  class ScheduleController {
    public function paymentSchedule($req) {
      $infoLoan = new PaymentScheduleModel($req);
      $schedule = new PaymentScheduleUseCase($infoLoan);
      $mapper = new Mapper();
      echo $mapper->mapRowToJSON($schedule->monthlyPayments());
      http_response_code(200);
      exit;
    }
  } 
?>