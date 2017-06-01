<?php 
/**
* 
*/
class Home extends MY_Controller
{
		function __construct()
	{
		parent::__construct();
		$this -> load -> model('TaiKhoan_model');
     
	}
	function index()
	{
		$this -> data['temp']= 'admin/home/index';
		$this -> load -> view('admin/main-layout',$this-> data);
		
	}
}
 ?>