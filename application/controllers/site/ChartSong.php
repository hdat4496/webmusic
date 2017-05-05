<?php 

class ChartSong extends CI_Controller
{
	
	function index()
	{
		$data = array();
		$data['temp']= 'site/chartsong/index';
		$this -> load -> view('site/layout',$data);
	}
}
 ?>