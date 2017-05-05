<?php 

class Album extends CI_Controller
{
	
	function index()
	{
		$data = array();
		$data['temp']= 'site/album/index';
		$this -> load -> view('site/layout',$data);
	}
}
 ?>