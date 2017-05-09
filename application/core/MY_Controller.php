<?php 
/**
* 
*/
class MY_Controller extends CI_Controller
{
	//biến gửi dữ liệu sang view
	public $data = array();
	
	function __construct()
	{
		parent::__construct();
		$controller = $this-> uri->segment(1);
		switch ($controller) {
			case 'admin':
			{
				$this -> load -> helper('admin');
				$this -> _check_login();
				break;
			}
			default:
				# code...
				break;
		}
	}

	private function _check_login()
	{

	}



}
?>