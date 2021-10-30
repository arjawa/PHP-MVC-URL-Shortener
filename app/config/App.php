<?php

class App
{
  protected $controller = "Pages";
  protected $method = "index";
  protected $params = [];
  
  public function __construct()
  {
    $url = $this->parseURL();
    $data = json_decode(file_get_contents(DATABASE));
    
    // Get Controller Name
    if (is_array($url) && file_exists('../app/controllers/'.ucfirst($url[0]).'.php')) 
    {
      $this->controller = ucfirst($url[0]);
      unset($url[0]);
    }
    // redirect to destination url
    else if (is_array($url) && isset($data->{$url[0]}))
    {
      return header("location: {$data->{$url[0]}}");
    }
    
    require_once('../app/controllers/'.$this->controller.'.php');
    $this->controller = new $this->controller;
    
    // Get Method Name
    if (isset($url[1]))
    {
      if (method_exists($this->controller, $url[1]))
      {
        $this->method = $url[1];
        unset($url[1]);
      }
    }
    
    // If Parameter Exists
    if (!empty($url))
    {
      $this->params = array_values($url);
      // var_dump($url);
    }
    
    // Execute Controller
    call_user_func_array([$this->controller, $this->method], $this->params);
  }
  
  public function parseURL()
  {
    if (isset($_GET['url']))
    {
      $url = rtrim($_GET['url'], "/");
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }
  }
}