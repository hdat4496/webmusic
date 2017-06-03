<?php
Class User extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this-> load->model('TaiKhoan_model');
    }
    
    /*
     * Kiểm tra email đã tồn tại chưa
     */
    function check_email()
    {
        $email = $this-> input->post('email');
        $where = array('email' => $email);
        //kiêm tra xem email đã tồn tại chưa
        if($this-> TaiKhoan_model->check_exists($where))
        {
            //trả về thông báo lỗi
            $this-> form_validation->set_message(__FUNCTION__, 'Email đã tồn tại');
            return false;
        }
        return true;
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
     * Đăng ký thành viên
     */
    function register()
    {
        $this-> load->library('form_validation');

        $this-> load->helper('form');
        
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
			$this-> form_validation-> set_rules('hoTen','Họ tên','required|min_length[8]|max_length[100]');
			$this-> form_validation-> set_rules('taiKhoan','Tên tài khoản','required|min_length[4]|max_length[30]|callback_check_taiKhoan');
			$this-> form_validation-> set_rules('matKhau','Mật khẩu','required|min_length[6]');
			$this-> form_validation-> set_rules('nhapLai_MatKhau','Nhập lại mật khẩu','matches[matKhau]');
			//$this-> form_validation-> set_rules('email','Email','required|valid_email|max_length[100]|callback_check_email');
  
            //nhập liệu chính xác
            if($this-> form_validation->run())
            {
                //them vao csdl
				//Thêm vào csdl
				$taiKhoan = $this-> input-> post('taiKhoan');
				$matKhau = $this-> input-> post('matKhau');
				$hoTen = $this-> input-> post('hoTen');	
				$email = $this-> input-> post('email');
				$gioiTinh = $this-> input-> post('gioiTinh');


				$data = array(
					'taiKhoan' => $taiKhoan,
					'matKhau' => md5($matKhau),
					'maQuyen' => 'Q02',
					'hoTen' => $hoTen,
					'email' => $email,
					'gioiTinh' => $gioiTinh
				);
                $this -> load -> library('upload_library');
				//Lấy tên file ảnh được upload lên
                $upload_path = './upload/img';
                $upload_data =$this -> upload_library -> upload($upload_path, 'image');
                $imageURL = '';
                if(isset($upload_data['file_name']))
                {
                    $imageURL= $upload_data['file_name'];
                    $data['imageURL'] = $imageURL;
                }


                if($this->TaiKhoan_model->create($data))
                {
                   //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Đăng ký thành viên thành công');
					// $message = "Đăng ký thành công";
					// echo "<script type='text/javascript'>alert('$message');</script>";
                }else{
                    $this->session->set_flashdata('message', 'Đăng ký thất bại');

                }
                //chuyen tới trang chủ
                redirect(base_url());
            }
        }
        
        //hiển thị ra view
            $this->session->set_flashdata('message', 'Dữ liệu nhập không chính xác!Vui lòng nhập lại');
                redirect(base_url());
    }
    
    /*
     * Kiem tra đăng nhập
     */
    function login()
    {


        $this-> load->library('form_validation');
        $this-> load->helper('form');
        
        if($this-> input->post())
        {
            $this-> form_validation->set_rules('tenTaiKhoanDangNhap', 'Tên đăng nhập', 'required');
            $this-> form_validation->set_rules('matKhauDangNhap', 'Mật khẩu', 'required|min_length[6]');
            $this-> form_validation->set_rules('login' ,'login', 'callback_check_login');
            if($this-> form_validation->run())
            {
                //lay thong tin thanh vien
                $user = $this->_get_user_info();
                //gắn session id của thành viên đã đăng nhập
                $this-> session->set_userdata('user_id_login', $user->taiKhoan);
                
                $this-> session->set_flashdata('message', 'Đăng nhập thành công');
                redirect();
            }
        }
        
        //hiển thị ra view
            $this-> session->set_flashdata('message', 'Sai tên đăng nhập hoặc tài khoản!Vui lòng đăng nhập lại');

                redirect();
    }

    
    //  * Kiem tra email va password co chinh xac khong
     
    function check_login()
    {
        $user = $this->_get_user_info();
        if($user)
        {

            return true;
        }
        $this-> form_validation->set_message(__FUNCTION__, 'Không đăng nhập thành công');
        return false;
    }
    
    /*
     * Lay thong tin cua thanh vien
     */
    private function _get_user_info()
    {
        $tenTaiKhoanDangNhap = $this->input->post('tenTaiKhoanDangNhap');
        $matKhauDangNhap = $this->input->post('matKhauDangNhap');
        $matKhauDangNhap = md5($matKhauDangNhap);
        
        $where = array('taiKhoan' => $tenTaiKhoanDangNhap , 'matKhau' => $matKhauDangNhap);
        $user = $this->TaiKhoan_model->get_info_rule($where);
        return $user;
    }
    
    

    /*
     * Thuc hien dang xuat
     */
    function logout()
    {
        if($this->session->userdata('user_id_login'))
        {
            $this->session->unset_userdata('user_id_login');
        }
       
        redirect();
    }
}

