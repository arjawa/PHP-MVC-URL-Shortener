<?php

class Pages extends BaseController
{
  public function index()
  {
    $this->view('templates/header');
    $this->view('pages/home');
    $this->view('templates/footer');
  }
}