<?php
  class Router {
    private $path;
    private $method;
    private $req;
    
    public function __construct() {
      $this->path = $_SERVER['PATH_INFO'];
      $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function getBody() {
      switch ($this->method) {
        case 'POST':
          $this->req = json_decode(file_get_contents('php://input'));
          break;
        case 'GET':
          $this->req = (object) $_GET;
          break;  
      }
    }
  
    public function get($route, $callback) {
      if ($this->method == "GET" && $this->path == $route) {
        $this->getBody();
        $callback($this->req);
      } elseif ($this->method != "GET" && $this->path == $route) {
        http_response_code(405);
        exit;
      }
    }
  
    public function post($route, $callback) {
      if ($this->method == "POST" && $this->path == $route) {
        $this->getBody();
        $callback($this->req);
      } elseif ($this->method != "POST" && $this->path == $route) {
        http_response_code(405);
        exit;
      }
    }
  }  
?>