<?php

class Actions extends BaseController
{
  public function insert()
  {
    header('Content-Type: application/json');
    if (isset($_POST['url']) && !empty(trim($_POST['url'])))
    {
      $url = $_POST['url'];
      $route = $this->randomstr(STRLENGTH);
      if (!preg_match("/(http|https)/", $url))
      {
        $url = "http://" . $url;
      }
      
      $_SESSION['url'] = $url;
      if ($data = json_decode(file_get_contents(DATABASE)))
      {
        $data->$route = $url;
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        
        if (file_put_contents(DATABASE, $jsonData))
        {
          $_SESSION['result'] = BASEURL . "/{$route}";
          $_SESSION['status'] = "Success";
        }
      }
    }
    else
    {
      $_SESSION['result'] = "Url can not be empty!";
      $_SESSION['url'] = "Invalid";
      $_SESSION['status'] = "Error";
    }
    
    header("location: /");
  }
  
  public function randomstr($length)
  {
    return mb_substr(str_shuffle(RANDOMSTR), 0, $length);
  }
}