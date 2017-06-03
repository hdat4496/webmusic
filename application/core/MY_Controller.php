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
					
					$message = $this -> session -> flashdata('message');
					$this -> data['message'] = $message;
					// Kiểm tra thành viên đăng nhập chưa
					$user_id_login=$this-> session -> userdata('user_id_login');
					$this -> data['user_id_login']= $user_id_login;
					///Nếu đăng nhập thành công thì lấy thông tin của thành viên
					if($user_id_login)
					{
						$this-> load -> model('TaiKhoan_model');
						$user_info = $this -> TaiKhoan_model -> get_info($user_id_login);
						$this -> data['user_info']= $user_info;  
					}
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