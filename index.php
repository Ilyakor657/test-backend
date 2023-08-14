<?php
  header("Access-Control-Allow-Origin: http://localhost:3000");
  header('Access-Control-Allow-Credentials: true');
  header("Access-Control-Allow-Headers: Content-Type");
  if ($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
    http_response_code(200);
    exit;
  }

  require_once 'src/Http/routers/index.php';
  
  http_response_code(404);
?>