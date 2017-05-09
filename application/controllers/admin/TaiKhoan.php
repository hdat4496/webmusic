<?php 
/**
* 
*/
class TaiKhoan extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this -> load -> model('TaiKhoan_model');
	}

	/*
	 * Lấy danh sách tài khoản
	 */
	
	function index()
	{
		$input = array();
		$input['where'] = array('maQuyen' => 'Q01');
		$list = $this -> TaiKhoan_model -> get_list($input);
		$this -> data['list'] = $list;
		$total = $this -> TaiKhoan_model -> get_total($input);
		$this-> data['total'] = $total;

		//lấy nội dung biến message
		$message = $this -> session -> flashdata('message');
		$this -> data['message'] = $message;

		$this -> data['temp'] = 'admin/taikhoan/index';
		$this -> load -> view('admin/main-layout', $this->data);
	}
	/*
	 * Kiểm tra tên tài khoản có tồn tại chưa
	 */
	function check_taiKhoan()
	{
		$taiKhoan = $this-> input-> post('taiKhoan');
		$where  = array('taiKhoan' => $taiKhoan);
		//Kiểm tra tên tài khoản đã tồn tại chưa
		if($this -> TaiKhoan_model -> check_exists($where))
		{
			$this -> form_validation -> set_message(__FUNCTION__,'Tài khoản đã tồn tại');
			return false;
		}
		return true;
	}

	/*
	 * Kiểm tra email có tồn tại chưa
	 */
	function check_email()
	{
		$email = $this-> input-> post('email');
		$where  = array('email' => $email);
		//Kiểm tra email đã tồn tại chưa
		if($this -> TaiKhoan_model -> check_exists($where))
		{
			$this -> form_validation -> set_message(__FUNCTION__,'Email đã tồn tại');
			return false;
		}
		return true;
	}


	/*
	 * Thêm mới tài khoản
	 */
	function add()
	{
		$this -> load -> library('form_validation');
		$this -> load -> helper('form');
		// Nếu có dữ liệu post lên
		if($this-> input-> post())
		{
			$this-> form_validation-> set_rules('hoTen','Họ tên','required|min_length[8]|max_length[100]');
			$this-> form_validation-> set_rules('taiKhoan','Tên tài khoản','required|min_length[4]|max_length[30]|callback_check_taiKhoan');
			$this-> form_validation-> set_rules('matKhau','Mật khẩu','required|min_length[6]');
			$this-> form_validation-> set_rules('nhapLai_MatKhau','Nhập lại mật khẩu','matches[matKhau]');
			$this-> form_validation-> set_rules('email','Email','required|valid_email|max_length[100]|callback_check_email');
			//Nhập liệu chính xác
			if($this -> form_validation -> run())
			{
				//Thêm vào csdl
				$taiKhoan = $this-> input-> post('taiKhoan');
				$matKhau = $this-> input-> post('matKhau');
				$hoTen = $this-> input-> post('hoTen');
				$imageURL = 'urlabc';
				$email = $this-> input-> post('email');
				$gioiTinh = $this-> input-> post('gioiTinh');

				$data = array(
					'taiKhoan' => $taiKhoan,
					'matKhau' => md5($matKhau),
					'maQuyen' => 'Q01',
					'hoTen' => $hoTen,
					'imageURL' => $imageURL,
					'email' => $email,
					'gioiTinh' => $gioiTinh
				);

				if($this -> TaiKhoan_model -> create($data)){
					//tạo nội dung thông báo
					$this-> session -> set_flashdata('message','Thêm tài khoản thành công.');
				}
				else{
					$this-> session -> set_flashdata('message','Thêm tài khoản không thành công.');
				}
				//chuyển tới trang  danh sách tài khoản quản trị
				redirect(admin_url('TaiKhoan'));
			}
		}
		$this -> data['temp'] = 'admin/taikhoan/add';
		$this -> load -> view('admin/main-layout', $this->data);
	}


	/*
	 * Chỉnh sửa tài khoản
	 */
	function edit()
	{
		//Lấy tên tài khoản
		$taiKhoan =$this -> uri -> rsegment('3');

		$this -> load -> library('form_validation');
		$this -> load -> helper('form');

		//Lấy thông tin
		$info = $this-> TaiKhoan_model ->get_info($taiKhoan);
		if(!$info)
		{
			$this-> session -> set_flashdata('message','Không tồn tại tài khoản.');		
			redirect(admin_url('TaiKhoan'));	
		}

		$this->data['info']= $info;
 	
		if($this-> input-> post())
		{
			$this-> form_validation-> set_rules('hoTen','Họ tên','required|min_length[8]');
			$this-> form_validation-> set_rules('matKhau','Mật khẩu','required|min_length[6]');
			$this-> form_validation-> set_rules('nhapLai_MatKhau','Nhập lại mật khẩu','matches[matKhau]');
			//Nhập liệu chính xác
			if($this -> form_validation -> run())
			{
				//cập nhật csdl
				$matKhau = $this-> input-> post('matKhau');
				$hoTen = $this-> input-> post('hoTen');
				$imageURL = 'urlabc';
				$gioiTinh = $this-> input-> post('gioiTinh');
				$data = array(
					'matKhau' => md5($matKhau),
					'hoTen' => $hoTen,
					'imageURL' => $imageURL,
					'gioiTinh' => $gioiTinh
				);	

					if($this -> TaiKhoan_model -> update($taiKhoan, $data)){
						//tạo nội dung thông báo
						$this-> session -> set_flashdata('message','Cập nhật tài khoản thành công.');
					}
					else{
						$this-> session -> set_flashdata('message','Cập nhật tài khoản không thành công.');
					}
				//chuyển tới trang  danh sách tài khoản quản trị
				redirect(admin_url('TaiKhoan'));		
			}

		}

		$this -> data['temp'] = 'admin/taikhoan/edit';
		$this -> load -> view('admin/main-layout', $this->data);
	}

    
    /*
     * Hàm xóa dữ liệu
     */
    function delete()
    {
        $taiKhoan = $this->uri->rsegment('3');

        //lay thong tin cua quan tri vien
		$info = $this-> TaiKhoan_model ->get_info($taiKhoan);
        if(!$info)
        {
            $this-> session->set_flashdata('message', 'Không tồn tại tài khoản này.');
            redirect(admin_url('taiKhoan'));
        }
        //thuc hiện xóa
        $this-> TaiKhoan_model->delete($taiKhoan);
        
        $this-> session->set_flashdata('message', 'Xóa tài khoản thành công.');
        redirect(admin_url('taiKhoan'));
    }






}

?>