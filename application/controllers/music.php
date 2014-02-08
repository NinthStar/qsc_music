<?php

class Music extends CI_Controller
{
  private $headData;
  private $upload_error;

  public function __construct()
  {
    parent :: __construct();

    define('UPLOAD_DIR','./music_upload');
    define('MAX_UPLOAD_TIMES','5');

    $this->load->model(array('user_model','music_model'));
    $this->load->library("session");

    $this->session->set_userdata('uid',1);
  }

  private function form_valid()
  {
    $this->load-library('form_validation');
    $config = array(
      /*array(
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
      ),*/
      array(
        'field' => 'styleId',
        'label' => '音乐风格',
        'rules' => 'trim|alpha_numeric|max_length[2]|xss_clean'
      ),
      array(
        'field' => 'musicName',
        'label' => '作品名称',
        'rules' => 'trim|required|xss_clean'
      ),
      array(
        'field' => 'ifPerformance',
        'label' => '能否进行表演',
        'rules' => 'trim|required|alpha_numeric|max_length[1]|xss_clean'
      ),
      array(
        'field' => 'description',
        'label' => '创作故事',
        'rules' => 'trim|required|max_length[400]|xss_clean'
      )
    );

    $this->form_validation->set_rules($config);

    $this->form_validation->set_message('required','请填写%d');
    $this->form_validation->set_message('valid_email','您所填写的邮箱格式有误');
    $this->form_validation->set_message('max_length','您所填写的%s超出长度要求');
    $this->form_validation->set_message('alpha_dash','你所填写的%s含有非法字符，请检查');
    $this->form_validation->set_message('alpha_numeric','您所填写的%s含有非法字符，请检查');
    $this->form_validation->set_error_delimiters('', '');

    if($this->form_validation->run() == FALSE)
    {
      $data['ifSuccess'] = 0;
      $data['error'] = validation_errors();
    }
    else
    {
      $data['ifSuccess'] = 1;
    }
    return $data;
  }

  public function get_music_info()
  {
    if ($this->input->get_post('mid') == NULL)
    {
      echo "请勿直接访问该网页";
      return;
    }
    $mid = $this->input->get_post('mid');

    if (($musicInfo = $this->music_model->get_music($mid)) == FALSE)
    {
      $data['ifSuccess'] = 0;
      echo json_encode($data);
      return;
    }
    $musicInfo['ifSuccess'] = 1;
    if (($this->session->userdata('uid') != NULL) && $this->music_model->if_voted($this->session->userdata('uid'),$mid))
    {
      $musicInfo['isVoted'] = 1;
    }
    else
    {
      $musicInfo['isVoted'] = 0;
    }
    echo json_encode($musicInfo);
  }

  public function music_upload()
  {
    $this->load->helper(array('url','form'));

    if (($this->session->userdata('uid') == NULL) || $this->input->server('HTTP_REFERER') != base_url())
    {
      $data['error'] = '请不要直接访问该页面！或请检查是否已经登录 !';
      $data['ifSuccess'] = 0;

      $jsonData['headData'] = $this->headData;
      $jsonData['mainData'] = $data;

      echo json_encode($jsonData);
      return ;
    }

    $validData = $this->from_valid();
    if ($validData['ifSuccess'] == 0)
    {
      echo json_encode($validData);
      return ;
    }

    $this->load->database();
    if ($this->music_model->get_upload_times($this->session->userdata('uid')) > MAX_UPLOAD_TIMES)
    {
      $data['error'] = '您上传数目超限！';
      $data['ifSuccess'] = 0;
      $jsonData['headData'] = $this->headData;
      $jsonData['mainData'] = $data;

      echo json_encode($jsonData);
      return ;
    }

    $config['upload_path'] = UPLOAD_DIR;
    $config['allowed_types'] = 'mp3|wmv|wav';
    $config['maxsize'] = '10240';
    $config['encrypt_name'] = 'TRUE';

    $this->load->library('upload',config);
    if ($this->upload->do_upload())
    {
      $musicInfo = array
        (
          'clientName' => $this->upload->data()['client_name'],
          'updateDate' => new Datetime(),
          'uid' => $this->session->userdata('uid')
        );
      $this->music_model->create($musicInfo);

      $data['ifSuccess'] = 1;
      $jsonData['headData'] = $this->headData;
      $jsonData['mainData'] = $data;

      echo json_encode($jsonData);
    }
    else
    {
      $data['error'] = $this->upload->display_errors();
      $data['ifSuccess'] = 0;
      echo json_encode($data);
    }
  }

  public function vote()
  {
    if ($this->input->get_post("mid") == NULL || $this->input->get_post("sign") == NULL)
    {
      echo "请勿直接访问该页面";
      return ;
    }
    $mid = $this->input->get_post('mid');
    $sign = $this->input->get_post('sign');

    if ($this->session->userdata('uid') == NUll)
    {
      $jsonData['ifSuccess'] = -3;
      $jsonData['error'] = '您尚未登录，请先登录';
      echo json_encode($jsonData);
      return ;
    }
    $jsonData['ifSuccess'] = $this->music_model->vote($this->session->userdata('uid'),$mid,$sign);
    echo json_encode($jsonData);
  }

  public function get_my_favorite()
  {
  }

  public function music_select()
  {
    if ($this->input->get_post('method') == NULL)
    {
      echo "请勿直接访问该页面";
      return ;
    }
    $method = $this->input->get_post('method');

    switch ($method)
    {
    case 4 : echo json_encode($this->music_model->get_music_list_by_rank(20)); break;
    case 3 :
      if ($this->input->get_post('key') == NULL)
      {
        echo "请勿直接访问该页面";
        return ;
      }
      $key = $this->input->get_post('key');
      $result = $this->music_model->get_music_list_by_key_word($key);
      if ($result == NULL)
      {
        $result['ifSuccess'] = 0;
      }
      else
      {
         $result['ifSuccess'] = 1;
      }
      echo json_encode($result);
      break;
    case 2:
      if ($this->input->get_post('key') == NULL)
      {
        echo "请勿直接访问该页面";
        return ;
      }
      $key = $this->input->get_post('key');
      echo json_encode($this->music_model->get_music_list_by_style($key));
      break;
    case 1:
      if ($this->input->get_post('key') == NULL)
      {
        echo "请勿直接访问该页面";
        return ;
      }
      $key = $this->input->get_post("key");
      echo json_encode($this->music_model->get_music_list_by_school($key));
    }
  }
}


