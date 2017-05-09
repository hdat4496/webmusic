<?php 

class ChartSong extends MY_Controller
{
	
	function index()
	{
		$data['temp']= 'site/chartsong/index';
		$data['title'] = 'Bảng xếp hạng';	
		$this -> load -> view('site/layout',$data);
	}
}
 ?>