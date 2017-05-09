<?php 

class Profile extends MY_Controller
{
	
	function index()
	{
		$data['temp']= 'site/profile/index';
		$data['title'] = 'Profile';	
		$this -> load -> view('site/layout',$data);
	}
}
 ?>