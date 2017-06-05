<?php 

class ThongTinNgheSi extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this -> load -> model('NgheSi_model');

     
	}	

	function ThongTin()
	{
		$maNgheSi = $this -> uri-> rsegment(3);
		$ngheSi = $this -> NgheSi_model -> get_info($maNgheSi);

		if(!$ngheSi)
		{	
			$this-> session -> set_flashdata('message','Không tồn tại nghệ sĩ này.');		
			redirect(base_url('site/MY_Error'));	
		}
 		$DSBaiHat = $this-> NgheSi_model -> layDSBaiHayCuaNgheSi($maNgheSi);
 		$data['DSBaiHat'] = $DSBaiHat;
		$data['ngheSi']= $ngheSi;
		$data['temp']= 'site/thongtinnghesi/index';
		$data['title'] = 'Thông tin';	
		$this -> load -> view('site/layout',$data);
	}
}
 ?>