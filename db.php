<?php
  class DB {
    private $host = 'localhost';
    private $port = '5433';
    private $dbname = 'test';
    private $user = 'postgres';
    private $password = '902109';
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
      $this->exist = true; 
    }

    public function connect() {
      return $this->db;
    }
  }
?>