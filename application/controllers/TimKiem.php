<?php 

class TimKiem extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this -> load -> model('BaiHat_model');
    $this -> load -> model('Album_model');
    $this -> load -> model('NgheSi_model');
  } 


  function index()
  {

    $type = $_POST["timkiem"];
    if(isset($_POST['searchbtn']) && $_POST["timkiem"]=='baihat') {
    
      $this->baiHat($_POST["search"]);
    }
    elseif(isset($_POST['searchbtn']) && $_POST["timkiem"]=='album') {
    
      $this->album($_POST["search"]);
    }
    elseif(isset($_POST['searchbtn']) && $_POST["timkiem"]=='nghesi') {
    
      $this->ngheSi($_POST["search"]);
    }



  }

  /**
   * Tìm kiếm bài hát
   *
   * @param array $_POST
   * @return void
   */
  public function baiHat($noiDung)
  {
    //lấy danh sách nghệ sĩ bài hát
    $query=$this-> db->query("call sp_Get_BaiHat_NgheSi()");
    mysqli_next_result($this->db->conn_id);
    $input['order'] = array('luotNghe','DESC');
    $input['like'] = array('tenBaiHat', $noiDung);
    $data['ketQua'] = $this-> BaiHat_model->get_list($input);
    $data['noiDung'] = $noiDung;
    $data['title'] = 'Tìm kiếm bài hát '.$noiDung;
    $data['temp'] = 'site/timkiem/index';
    $data['type'] = 'baihat';
    $data['nghesi']=$query->result();
    $this->load->view("site/layout", $data);
  }

  /**
   * Tìm kiếm album
   *
   * @param array $_POST
   * @return void
   */
  public function album($noiDung)
  {
    $input['order'] = array('luotNghe','DESC');
    $input['like'] = array('tenAlbum', $noiDung);
    $data['ketQua'] = $this-> Album_model->get_list($input);
    $data['noiDung'] = $noiDung;
    $data['title'] = 'Tìm kiếm album '.$noiDung;
    $data['temp'] = 'site/timkiem/index';
    $data['type'] = 'album';
    $this->load->view("site/layout", $data);
  }

  /**
   * Tìm kiếm nghệ sĩ 
   *
   * @param array $_POST
   * @return void
   */
  public function ngheSi($noiDung)
  {
    $input['like'] = array('tenNgheSi', $noiDung);
    $data['ketQua'] = $this-> NgheSi_model->get_list($input);
    $data['noiDung'] = $noiDung;
    $data['title'] = 'Tìm kiếm nghệ sĩ '.$noiDung;
    $data['temp'] = 'site/timkiem/index';
    $data['type'] = 'nghesi';
    $this->load->view("site/layout", $data);
  }
}
 ?>