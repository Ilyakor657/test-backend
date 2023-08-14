<?php
  class DataBase {
    private $host = 'localhost';
    private $port = '5433';
    private $dbname = 'test';
    private $user = 'postgres';
    private $password = '';
    private static $instance;
    private $connect;

    private function __construct() {
      $connectString = "
        host={$this->host} 
        port={$this->port} 
        dbname={$this->dbname} 
        user={$this->user} 
        password={$this->password}
      ";
      $this->connect = pg_connect($connectString);
      if (!$this->connect) {
        http_response_code(400);
        exit;
      }
    }

    public static function getInstance() {
        if (self::$instance == null) {
          self::$instance = new DataBase();
        }
        return self::$instance;
    }

    public function getConnect() {
      return $this->connect;
    }
  }
?>