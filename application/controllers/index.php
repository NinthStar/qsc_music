<?php

class Index extends CI_Controller
{
    public function __construct()
    {
      parent :: __construct();
    }
    public function index()
    {
      $this->load->view('header.php');
      $this->load->view('main.php');
      $this->load->view('footer.php');
    }

}

