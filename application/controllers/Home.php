<?php 

class Home extends MY_Controller
{
	
	function index()
	{
		$this -> load -> model('Slide_model');
		$input['order'] = array('thuTuHienThi','ASC');
		$slide_list = $this-> Slide_model -> get_list($input);

		$this -> load -> model('BaiHat_model');
		$input_baihatnew['limit']= array(16,0);
		$baihat_new = $this -> BaiHat_model-> get_list($input_baihatnew); 

		$input_topnghenhieu['limit']= array(15,0);
		$input_topnghenhieu['order']= array('luotNghe','DESC');
		$baihat_nghenhieu = $this -> BaiHat_model-> get_list($input_topnghenhieu); 

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

		$message = $this -> session -> flashdata('message');
		$this -> data['message'] = $message;


		//lấy danh sách nghệ sĩ bài hát
		$query=$this-> db->query("call sp_Get_BaiHat_NgheSi()");
		mysqli_next_result($this->db->conn_id);

		//lấy danh sách bài hát nghe nhiều trong 7 ngày
		$query_toptrend=$this-> db->query("call sp_Get_BaiHat_TopTrend()");
		mysqli_next_result($this->db->conn_id);


		$data =array();
		$data['temp']= 'site/home/index';
		$data['title'] = 'Music';
		$data['slide_list']=$slide_list;
		$data['baihat_new']=$baihat_new;
		$data['baihat_nghenhieu']=$baihat_nghenhieu;
		$data['baihat_xephang_vn']= $baihat_xephang_vn;	
		$data['baihat_xephang_aumy']= $baihat_xephang_aumy;	
		$data['baihat_xephang_hq']= $baihat_xephang_hq;
		$data['nghesi']=$query->result();
		$data['toptrend']=$query_toptrend->result();
			
		$this -> load -> view('site/layout',$data);

	}
}
 ?>