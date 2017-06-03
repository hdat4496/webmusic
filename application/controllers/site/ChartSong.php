<?php 

class ChartSong extends MY_Controller
{
	
	function index()
	{
		// $this -> load -> model('BaiHat_model');
		// $input['order'] = array('thuTuHienThi','ASC');
		// $slide_list = $this-> BaiHat_model -> get_list($input);

		$data['temp']= 'site/chartsong/index';
		$data['title'] = 'Bảng xếp hạng';	
		$this -> load -> view('site/layout',$data);
	}
}
 ?>