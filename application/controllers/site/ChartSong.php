<?php 

class ChartSong extends MY_Controller
{
	
	function index()
	{
		$this -> load -> model('BaiHat_model');
		// $input['order'] = array('thuTuHienThi','ASC');
		// $slide_list = $this-> BaiHat_model -> get_list($input);

		$input_baihat_xephang_vn['limit']= array(7,0);
		$input_baihat_xephang_vn['order']= array('luotNghe','DESC');
		$input_baihat_xephang_vn['where'] = array('maQuocGia' => 'QG001');	
		$baihat_xephang_vn = $this -> BaiHat_model-> get_list($input_baihat_xephang_vn); 

		$input_baihat_xephang_aumy['limit']= array(7,0);
		$input_baihat_xephang_aumy['order']= array('luotNghe','DESC');
		$input_baihat_xephang_aumy['where'] = array('maQuocGia' => 'QG003');	
		$baihat_xephang_aumy = $this -> BaiHat_model-> get_list($input_baihat_xephang_aumy); 

		$input_baihat_xephang_hq['limit']= array(7,0);
		$input_baihat_xephang_hq['order']= array('luotNghe','DESC');
		$input_baihat_xephang_hq['where'] = array('maQuocGia' => 'QG016');	
		$baihat_xephang_hq = $this -> BaiHat_model-> get_list($input_baihat_xephang_hq);
		//lấy danh sách nghệ sĩ bài hát
		$query=$this-> db->query("call sp_Get_BaiHat_NgheSi()");
		mysqli_next_result($this->db->conn_id);



		$data['temp']= 'site/chartsong/index';
		$data['title'] = 'Bảng xếp hạng';	
		$data['baihat_xephang_vn']= $baihat_xephang_vn;
		$data['baihat_xephang_hq']= $baihat_xephang_hq;
		$data['baihat_xephang_aumy']= $baihat_xephang_aumy;
		$data['nghesi']=$query->result();	
		$this -> load -> view('site/layout',$data);
	}
}
 ?>