<?php
  class Methods
  {
    private $req;
    private $url;
    private $method;
  
    public function resolve($url, $body)
    {
      $this->url = $url['REQUEST_URI'];
      $this->req = json_decode($body);
      $this->method = $url['REQUEST_METHOD'];
    }
  
    public function get($route, $callback)
    {
      if ($this->method == "GET" && $this->url == $route) {
        $callback($this->req);
      }
    }
  
    public function post($route, $callback)
    {
      if ($this->method == "POST" && $this->url == $route) {
        $callback($this->req);
      }
    }
  } 
?>