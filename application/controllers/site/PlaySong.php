<?php 

class PlaySong extends MY_Controller
{
	
	function index()
	{
		$data['temp']= 'site/playsong/index';
		$data['title'] = 'Song';	
		$this -> load -> view('site/layout',$data);
	}
}
 ?>