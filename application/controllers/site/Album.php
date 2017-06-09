<?php 

class Album extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this -> load -> model('ChuDe_model');
		$this -> load -> model('Album_model');
	}	


	function index()
	{

		$list_chude = $this -> ChuDe_model -> get_list();
		$this -> data['list_chude'] = $list_chude;

		$data['temp']= 'site/album/index';
		$data['title'] = 'Album';		
		$this -> load -> view('site/layout',$data);

	}

	function view()
	{
		$maChuDe = $this -> uri-> rsegment(3);
		$list_chude = $this -> ChuDe_model -> get_list();
		$this -> data['list_chude'] = $list_chude;
		$chuDe = $this -> ChuDe_model -> get_info($maChuDe);

		$list_baihat_album= $this -> Album_model -> layDSAlbumChuDe($maChuDe);

        //lấy danh sách nghệ sĩ album
        $query=$this-> db->query("call sp_Get_Album_NgheSi()");
        mysqli_next_result($this->db->conn_id);

        $data['nghesi']=$query->result(); 
		$data['chuDe'] = $chuDe;
		$data['list_baihat_album']=$list_baihat_album;
		$data['temp']= 'site/album/index';
		$data['title'] = 'Album';		
		$this -> load -> view('site/layout',$data);

	}
}
 ?>