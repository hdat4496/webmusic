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
				{
					
				}
		}
	}

	private function _check_login()
	{
		$controller = $this -> uri -> rsegment('1');	 
		$controller = strtolower($controller);

		$login  = $this -> session -> userdata('login');
        //Nếu chưa đăng nhập mà truy cập vào 1 controller khác
        if(!$login && $controller != 'login')
        {
            redirect(admin_url('login'));
        }
        //Nếu admin đã đăng nhập thì k cho phép vào trang admin nữa
        if($login && $controller == 'login')
        {
            redirect(admin_url('home'));
        }
	}



}
?>