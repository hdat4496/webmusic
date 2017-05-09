<?php 

class Album extends MY_Controller
{
	
	function index()
	{
		$data['temp']= 'site/album/index';
		$data['title'] = 'Album';		
		$this -> load -> view('site/layout',$data);
	}
}
 ?>