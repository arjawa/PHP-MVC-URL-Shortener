<?php
session_start();

class BaseController
{
  public function view($view, $data = [])
  {
    require_once('../app/views/'.$view.'.php');
  }
}