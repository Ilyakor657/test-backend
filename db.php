<?php
  class DB {
    private $host = 'localhost';
    private $port = '5433';
    private $dbname = 'test';
    private $user = 'postgres';
    private $password = '902109';
    private $db;

    public function __construct() {
      $connectString = "
        host={$this->host} 
        port={$this->port} 
        dbname={$this->dbname} 
        user={$this->user} 
        password={$this->password}
      ";
      $this->db = pg_connect($connectString);
    }

    public function connect() {
      return $this->db;
    }
  }
?>