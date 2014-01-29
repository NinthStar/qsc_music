<?php

class Music_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function get_upload_times($uid)
  {
    $query = $this->db->select('uploadTimes')->where('uid',$uid)->get('user');

    if ($query->num_rows() === 0) return -1;
    else return $query->row()->uploadTimes;
  }

  public function create($data)
  {
    $postData = array(
      'styleId' => $this->input->post('styleId'),
      'musicName' => $this->input->post('musicName'),
      'ifPerformance' => $this->input->post('ifPerformance'),
      'description' => $this->input->post('description')
    );

    $data = array_merge($data,$postData);
    $this->db->insert('music',$data);
  }

  public function get_music($mid)
  {
    $this->db->join('user','user.uid = music.uid')->join('style','music.styleId = style.styleId')->where('mid',$mid);
    $query = $this->db->get('music');
    if ($query->num_rows() == 0) return FALSE;
    $result = $query->row_array();
    return $result;
  }

  public function if_voted($uid,$mid)
  {
    $query = $this->db->where('mid',$mid)->where('uid',$uid)->get('votelist');
    if ($query->num_rows() !== 0) return TRUE;
    else return FALSE;
  }

  public function vote($uid,$mid,$sign) //if $sign == 1 then vote++ else vote--
  {
    if ($this->db->get_where('music',array('mid' => $mid))->num_rows() == 0) return -2;
    if ($sign != 1 && $sign != -1) return -4;
    $query = $this->db->where('mid',$mid)->where('uid',$uid)->get('votelist');
    if (($query->num_rows() != 0 && ($sign == 1))||($query->num_rows() == 0 && ($sign == -1))) return -1;
    else
    {
      if ($sign == 1)
      {
        $this->db->insert('votelist',array('mid' => $mid,'uid' => $uid));
        $this->db->set('votes', 'votes+1', FALSE);

      }
      else
      {
        $this->db->where('uid',$uid)->where('mid',$mid)->delete('votelist');
        $this->db->set('votes','votes-1',FAlSE);
      }
      $this->db->where(array('mid' => $mid));
      $this->db->update('music');
    }
    return 1;
  }

  public function get_music_list_by_rank($sum)
  {
    $query = $this->db->select("mid,musicName,userName")->order_by("votes","desc")->limit($sum)->get("music");
    return $query->result_array();
  }

  public function get_music_list_by_key_word($key)
  {
    $query = $this->db->select("mid,musicName,userName")->like("musicName",$key)->or_like("userName",$key)->get("music");
    return $query->result_array();
  }

  public function get_music_list_by_style($key)
  {
    $query = $this->db->select("mid,musicName,userName")->where('styleId',$key)->order_by('uploadDate','desc')->get("music");
    return $query->result_array();
  }

  public function get_music_list_by_school($key)
  {
    $query = $this->db->select("mid,musicName,userName")->where('schoolId',$key)->order_by('uploadDate','desc')->get("music");
    return $query->result_array();
  }
}

