<?php
  require_once 'router.php';
  require_once 'src/Http/Controllers/ReportController.php';
  $router = new Router();

  $router->post("/paymentReport", function ($req) {(new ReportController())->paymentReport($req);});
?>