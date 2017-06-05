<?php 

class MY_Error extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

	}	


	function index()
	{

		$data['temp']= 'site/error/index';
		$data['title'] = 'Error';		
		$this -> load -> view('site/layout',$data);

	}
}
 ?>