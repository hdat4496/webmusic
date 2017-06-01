<?php 
/**
* 
*/
class Login extends MY_Controller
{
	
	function index()
	{
		$this -> load -> library('form_validation');
		$this -> load -> helper('form');
		$this-> load -> model('TaiKhoan_model');
		if($this -> input -> post())
		{
			$this-> form_validation->set_rules('login','login','callback_check_login');
			if($this -> form_validation -> run()){
				
				redirect(admin_url('Home'));			
			}
		}

		$this -> load -> view('admin/login/index');
	}
    /**
	 * Kiểm tra tên tài khoản với mật khẩu có đúng không? 
	 */
	function check_login()
	{
		$taiKhoan = $this -> input -> post('username');
		$matKhau = $this -> input -> post('password');
		$matKhau = md5($matKhau);

		$this -> load -> model('TaiKhoan_model');
		$where = array('taiKhoan'=> $taiKhoan, 'matKhau'=> $matKhau);
		if($this -> TaiKhoan_model->check_exists($where)){
			$this -> session -> set_userdata(array(
					'login'=> true,
					'taiKhoan' => $this -> TaiKhoan_model -> get_info($taiKhoan)
					));
			return true;
		}
		$this -> form_validation-> set_message(__FUNCTION__, 'Không đăng nhập thành công');
		return false;
	}
}
 ?>