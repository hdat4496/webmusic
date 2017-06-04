<?php 

class ThongTinNgheSi extends MY_Controller
{
	
	function index()
	{
		$data['temp']= 'site/thongtinnghesi/index';
		$data['title'] = 'Thông tin';	
		$this -> load -> view('site/layout',$data);
	}
}
 ?>