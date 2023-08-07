<?php
  require_once 'db.php';

  class ApplicationModel {
    private $db;

    public function __construct() {
      $this->db = (new DB())->connect();
    }

    public function createApllication($product, $client_id) {
      $queryString = "INSERT INTO applications (type, amount, rate, date_open, date_close, client_id)
        VALUES ('".$product->type."', '".$product->amount."',
        '".$product->rate."', '".$product->dateOpen."', '".$product->dateClose."', 
        '".$client_id."') RETURNING id";
      $result = pg_query($this->db, $queryString);
      if (!$result) {
        http_response_code(400);
        exit;
      }
    }

    public function getApllication() {
      $result = pg_fetch_object(pg_query($this->db, "SELECT * FROM applications"));
      if (!$result) {
        http_response_code(400);
        exit;
      } 
      while ($application = $result) {
        echo var_dump($application);
      }
    }
  } 
?>