<?php 

class PlaySong extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this -> load -> model('BaiHat_model');

	}


	function Play()
	{
		$maBaiHat = $this -> uri-> rsegment(3);
		$baiHat = $this -> BaiHat_model -> get_info($maBaiHat);

		//lấy danh sách nghệ sĩ bài hát
		$query=$this-> db->query("call sp_Get_NgheSi_maBH('$maBaiHat')");
		mysqli_next_result($this->db->conn_id);

		$data['nghesi']=$query->result();
		$data['baihat'] = $baiHat;
		$data['temp']= 'site/playsong/index';
		$data['title'] = 'Song';	
		$this -> load -> view('site/layout',$data);
	}
}
 ?>