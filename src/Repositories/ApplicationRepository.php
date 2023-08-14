<?php
  require_once 'config/database.php';

  class ApplicationRepository {
    private $db;

    public function __construct() {
      $database = DataBase::getInstance();
      $this->db = $database->getConnect();
    }

    public function createApplication($product, $client_id) {
      $queryString = "INSERT INTO applications (type, amount, rate, date_open, date_close, client_id)
        VALUES ('".$product->getType()."', '".$product->getAmount()."',
        '".$product->getRate()."', '".$product->getDateOpen()."', '".$product->getDateClose()."', 
        '".$client_id."') RETURNING id";
      $result = pg_query($this->db, $queryString);
      if (!$result) {
        http_response_code(400);
        exit;
      }
    }
  } 
?>