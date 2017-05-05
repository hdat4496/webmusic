<?php 

class PlaySong extends CI_Controller
{
	
	function index()
	{
		$data = array();
		$data['temp']= 'site/playsong/index';
		$this -> load -> view('site/layout',$data);
	}
}
 ?>