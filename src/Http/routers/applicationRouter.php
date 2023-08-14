<?php
  require_once 'router.php';
  require_once 'src/Http/Controllers/ApplicationController.php';
  $router = new Router();

  $router->post("/createApplication", function ($req) {(new ApplicationController())->createApplication($req);});
?>