<?php

class User extends CI_Controller
{
  public function __construct()
  {
    parent :: __construct();
    $this->load->model(array('user_model','music_model','log_model'));
    $this->load->library('session');
    $this->load->helper('cookie');
    $this->session->set_userdata('uid',1);
  }

  public function get_captcha()
  {
    $this->load->helper("url");
    $this->load->helper('captcha');
    $vals = array
      (
        'img_path' => './captcha/',
        'img_url' => base_url().'captcha/',
      );
    $cap = create_captcha($vals);

    $this->session->set_userdata('captcha',$cap['word']);
    echo $cap['image'];
  }

  public function get_head_data()
  {
    if ($this->session->userdata('uid') != NULL)
    {
      $data['userName'] = $this->session->userdata('userName');
      $data['ifLogin'] = 1;
      echo json_encode($data);
    }
    else
    {
      $data['ifLogin'] = 0;
      echo json_encode($data);
    }
  }

  public function login()
  {
    $this->load->helper("security");

    $emailAddress = $this->input->post('emailAddress');
    $password = do_hash($this->input->post('password'));

    if ($emailAddress != NULL && $password != NULL)
    {
      $data = $this->user_model->login_check($emailAddress,$password);
      if ($data['ifSuccess'] == 0)
      {
        echo json_encode($data);
        return ;
      }
      $this->session->set_userdata("userName",$data['userName']);
      $this->session->set_userdata("uid",$data['uid']);
      $jsonData['ifSuccess'] = 1;
      echo json_encode($jsonData);
      return ;
    }
    $jsonDat['ifSuccess'] = 0;
    echo json_encode($jsonData);
    return ;
  }

  public function register()
  {
    if (@ $this->input->cookie('ifRegistered') == 1)
    {
      $data['ifSuccess'] = -1;
      $data['error'] = "您已注册，请勿重复注册";
      echo json_encode($data);
      return ;
    }
    if (($this->session->userdata('uid') == NULL))
    {
      $data['ifSuccess'] = -2;
      $data['error'] = '您已登陆，无需注册';
      echo json_encode($data);
      return ;
    }

    $this->load->library('form_validation');
    $config = array(
      array(
        'field' => 'userName',
        'label' => '姓名',
        'rules' => 'trim|required|xss_clean'
      ),
      array(
        'field' => 'nickName',
        'label' => '艺名',
        'rules' => 'trim|xss_clean'
      ),
      array(
        'field' => 'selfIntro',
        'label' => '自我介绍',
        'rules' => 'trim|required|max_length[200]|xss_clean'
      ),
      array(
        'field' => 'tel1',
        'label' => '电话1',
        'rules' => 'trim|required|alpha_dash|xss_clean'
      ),
      array(
        'field' => 'tel2',
        'label' => '电话2',
        'rules' => 'trim|alpha_dash|xss_clean'
      ),
      array(
        'field' => 'schoolId',
        'label' => '所在大学',
        'rules' => 'trim|required|max_length[2]|alpha_numeric|xss_clean'
      ),
      array(
        'field' => 'emailAddress',
        'label' => '电子邮箱',
        'rules' => 'trim|required|valid_email|xss_clean'
      ),
      array(
        'field' => 'qq',
        'label' => 'QQ',
        'rules' => 'trim|alpha_numeric|xss_clean'
      ),
      array(
        'field' => 'wechat',
        'label' => '微信',
        'rules' => 'trim|alpha_dash|xss_clean'
      ),
      array(
        'field' => 'ifOpen',
        'label' => '是否公开个人信息',
        'rules' => 'trim|alpha_numeric|xss_clean'
      ),
      array(
        'field' => 'captcha',
        'label' => '验证码',
        'rules' => 'trim|alpha_dash|xss_clean'
      ),
      array(
        'field' => 'password',
        'label' => '密码',
        'rules' => 'trim|alpha_dash|xss_clean'
      )
    );

    $this->form_validation->set_rules($config);

    $this->form_validation->set_message('required','请填写%d');
    $this->form_validation->set_message('valid_email','您所填写的邮箱格式有误');
    $this->form_validation->set_message('max_length','您所填写的%s超出长度要求');
    $this->form_validation->set_message('alpha_dash','你所填写的%s含有非法字符，请检查');
    $this->form_validation->set_message('alpha_numeric','您所填写的%s含有非法字符，请检查');

    if($this->form_validation->run() == FALSE)
    {
      $data['ifSuccess'] = 0;
      $data['error'] = validation_errors();
      echo json_encode($data);
      return ;
    }

    if(($this->session->userdata('captcha') == NULL) ||
      strcasecmp($this->session->userdata('captcha'), $this->input->post('captcha')) != 0)
    {
      $data['ifSuccess'] = -3;
      $data['error'] = '验证码错误请重新输入';
      echo json_encode($data);
      return ;
    }

    $data['ifSuccess'] = 1;
    $uid = $this->user_model->register();
    $this->input->set_cookie('ifRegistered',1,'31536000');
    $this->session->set_userdata('uid',$uid);
    $this->session->set_userdata('userName',$this->input->post('userName'));
    $this->session->unset_userdata('captcha');
    $this->log_model->create_user_log($uid);
    echo json_encode($data);
  }

}
