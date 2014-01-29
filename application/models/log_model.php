<?php

class Log_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function create_user_log($uid)
  {
    $data = array(
      'ipAddress' => $this->input->ip_address(),
      'userAgent' => $this->input->user_agent(),
      'uid' => $uid
    );

    $this->db->insert('log',$data);
    return ;
  }
}
