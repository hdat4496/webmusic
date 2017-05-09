<?php 

class Home extends MY_Controller
{
	
	function index()
	{
		$data['temp']= 'site/home/index';
		$data['title'] = 'Music';
		$this -> load -> view('site/layout',$data);
	}
}
 ?>