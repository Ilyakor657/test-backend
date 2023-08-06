<?php
  require_once 'routes.php';
  require_once 'controllers/scheduleController.php';
  $router = new Router();

  $router->post("/paymentSchedule", function ($req) {(new ScheduleController())->paymentSchedule($req);});
?>