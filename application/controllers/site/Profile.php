<?php 

class Profile extends CI_Controller
{
	
	function index()
	{
		$data = array();
		$data['temp']= 'site/profile/index';
		$this -> load -> view('site/layout',$data);
	}
}
 ?>