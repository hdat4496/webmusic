<?php 

class PlayAlbum extends CI_Controller
{
	
	function index()
	{
		$data = array();
		$data['temp']= 'site/playalbum/index';
		$this -> load -> view('site/layout',$data);
	}
}
 ?>