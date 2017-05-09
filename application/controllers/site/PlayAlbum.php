<?php 

class PlayAlbum extends MY_Controller
{
	
	function index()
	{
		$data['temp']= 'site/playalbum/index';
		$data['title'] = 'Album';	
		$this -> load -> view('site/layout',$data);
	}
}
 ?>