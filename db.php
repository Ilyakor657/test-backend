<?php
  class DB {
    private $host = 'localhost';
    private $port = '5433';
    private $dbname = 'test';
    private $user = 'postgres';
    private $password = '';
    private $db;
    private $exist;

    public function __construct() {
      if ($this->exist) {
        return $this->db;
      }
      $connectString = "
        host={$this->host} 
        port={$this->port} 
        dbname={$this->dbname} 
        user={$this->user} 
        password={$this->password}
      ";
      $this->db = pg_connect($connectString);
      if (!$this->db) {
        http_response_code(400);
        exit;
      } else {
        $this->exist = true; 
      }
    }

    public function connect() {
      return $this->db;
    }
  }
?>