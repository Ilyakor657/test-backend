<?php
  header("Access-Control-Allow-Origin: http://localhost:3000");
  header('Access-Control-Allow-Credentials: true');
  header("Access-Control-Allow-Headers: Content-Type");
  
  require 'routes/index.php';
?>