<?php
  require_once 'routes.php';
  require_once 'controllers/reportController.php';
  $router = new Router();

  $router->post("/paymentReport", function ($req) {(new ReportController())->paymentReport($req);});
?>