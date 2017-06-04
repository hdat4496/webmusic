<?php 

class Profile extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this -> load -> model('BaiHat_model');

     
	}

	function index()
	{
		$data['temp']= 'site/profile/index';
		$data['title'] = 'Profile';	
		$this -> load -> view('site/layout',$data);
	}
}
 ?>