<?php
  require_once 'router.php';
  require_once 'src/Http/Controllers/ScheduleController.php';
  $router = new Router();

  $router->post("/paymentSchedule", function ($req) {(new ScheduleController())->paymentSchedule($req);});
?>