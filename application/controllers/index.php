<?php

class Index extends CI_Controller
{
    private $headData;

    public function __construct()
    {
        parent :: __construct();

        $this->load->model();
        $this->load->library("session");

        if (@(isset($this->session->userdata['loginName'])))
            $headData['loginName'] = $this->session->userdata['loginName'];
    }

    public function login($uid,$username,$token)
    {
    }
}

