<?php
  require_once 'methods.php';
  require_once 'controllers/applicationController.php';

  $router = new Methods();
  $router->resolve($_SERVER, file_get_contents('php://input'));
  
  $router->post("/createApplication", function ($req) {
    $application = new Application();
    $application->createApplication($req);
  });
  $router->get("/getApplication", function () {
    $application = new Application();
    $application->getApplication();
  }); 
?>