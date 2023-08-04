<?php
  require_once 'routes.php';
  require_once 'controllers/applicationController.php';
  $router = new Router();

  $router->post("/createApplication", function ($req) {(new ApplicationController())->createApplication($req);});
  $router->get("/getApplication", function ($req) {(new ApplicationController())->getApplication($req);});
?>