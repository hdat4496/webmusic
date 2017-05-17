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
		}
	}

	private function _check_login()
	{
		$controller = $this -> uri -> rsegment('1');	 
		$controller = strtolower($controller);

		$login  = $this -> session -> userdata('login');
        //neu ma chua dang nhap,ma truy cap 1 controller khac login
        if(!$login && $controller != 'login')
        {
            redirect(admin_url('login'));
        }
        //neu ma admin da dang nhap thi khong cho phep vao trang login nua.
        if($login && $controller == 'login')
        {
            redirect(admin_url('home'));
        }
	}



}
?>