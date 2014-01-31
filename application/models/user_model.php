<?php

class User_model extends CI_Model
{
  private $uid;
  private $pwd;
  private $data;

  public function __construct()
  {
    date_default_timezone_set("GMT");
    $this->load->helper("cookie");
    $this->load->database();
  }

  private function create_table($uid)
  {
    $this->load->database();
    $sql = "CREATE TABLE {$uid}_list(
      votedId INT(11) NOT NULL
    )";
    $this->db->query($sql);
  }

  public function login_check($emailAddress,$password)
  {
    $emailAddress = strtoupper($emailAddress);
    $this->db->select('userName,mid')->from('user');
    $this->db->where('emailAddress',$emailAddress);
    $query = $this->db->get();
    $data = $query->row_array();
    $pwd = $data['password'];
    unset($data['password']);
    $password = urlencode($password);
    if ($pwd != crypt($password,$pwd))
    {
      $data['ifSuccess'] = 0;
      return $data;
    }
    $data['ifSuccess'] = 1;
    return $data;
  }

  public function register()
  {
    $this->load->helper('security');
    $postData = array(
      'userName' => $this->input->post('userName'),
      'password' => crypt(urlencode($this->input->post('password'))),
      'nickName' => $this->input->post('nickName'),
      'selfIntro' => $this->input->post('selfIntro'),
      'tel1' => $this->input->post('tel1'),
      'tel2' => $this->input->post('tel2'),
      'schoolId' => $this->input->post('schoolId'),
      'emailAddress' => strtoupper($this->input->post('emailAddress')),
      'qq' => $this->input->post('qq'),
      'wechat' => $this->input->post('ifPerformance'),
      'ifOpen' => $this->input->post('ifOpen')
    );

    $this->db->insert('user',$postData);
    $uid = $this->db->insert_id();
    return $uid;
  }
}
