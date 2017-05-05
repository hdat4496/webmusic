<?php 
/**
* 
*/
class TaiKhoan extends MY_Controller
{
	function create()
	{
		$this -> load -> model('TaiKhoan_model');
		$data = array();
		$data['taiKhoan']= 'admin1';
		$data['matKhau']= 'matKhau1';
		$data['maQuyen']= '1';
		$data['hoTen']= 'hoTen1';
		$data['imageURL']= 'imageURL1';
		$data['email']= 'email1';
		$data['gioiTinh']= 'gioiTinh1';

		if( $this-> TaiKhoan_model-> create($data))
		{
			echo 'thành công';
		}
		else
		{
			echo 'không thành công';
		}

	}
}

 ?>