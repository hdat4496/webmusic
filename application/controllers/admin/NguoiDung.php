<?php 
/**
* 
*/
class NguoiDung extends MY_Controller
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

		//Lấy số lượng người dùng
		$total_rows = $this -> TaiKhoan_model-> get_total();
		$this -> data['total_rows'] = $total_rows;

		//load thư viện phân trang
		$this -> load -> library('pagination');
		$config = array();
		$config['total_rows'] = $total_rows;// tổng tất cả bài hát
        $config['base_url']   = admin_url('NguoiDung/index'); //link hien thi ra danh sach san pham
        $config['per_page']   = 10;//Số lượng bài hát trên 1 trang
        $config['uri_segment'] = 4;//phân đoạn hiển thị số trang trên url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        $config['reuse_query_string'] = TRUE;

        //khởi tạo các cấu hình trang
        $this->pagination->initialize($config);    
         
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array($config['per_page'], $segment);

        //Kiểm tra có thực hiện lọc k
        $input['where'] = array();
        $taiKhoan = $this->input->get('taiKhoan');
        if($taiKhoan)
        {
            $input['like'] = array('taiKhoan', $taiKhoan);
        }

        $hoTen = $this->input->get('hoTen');
        if($hoTen)
        {
            $input['like'] = array('hoTen', $hoTen);
        }

        $email = $this->input->get('email');
        if($email)
        {
            $input['like'] = array('email', $email);
        }

		$input['where'] = array('maQuyen' => 'Q02');

		$list = $this -> TaiKhoan_model -> get_list($input);
		$this -> data['list'] = $list;
		$total = $this -> TaiKhoan_model -> get_total($input);
		$this-> data['total'] = $total;

		//lấy nội dung biến message
		$message = $this -> session -> flashdata('message');
		$this -> data['message'] = $message;

		$this -> data['temp'] = 'admin/nguoidung/index';
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
				$email = $this-> input-> post('email');
				$gioiTinh = $this-> input-> post('gioiTinh');


                $this -> load -> library('upload_library');

				$data = array(
					'taiKhoan' => $taiKhoan,
					'matKhau' => md5($matKhau),
					'maQuyen' => 'Q02',
					'hoTen' => $hoTen,
					'email' => $email,
					'gioiTinh' => $gioiTinh
				);
                //Lấy tên file ảnh được upload lên
                $upload_path = './upload/img';
                $upload_data =$this -> upload_library -> upload($upload_path, 'image');
                $imageURL = '';
                if(isset($upload_data['file_name']))
                {
                    $imageURL= $upload_data['file_name'];
                    $data['imageURL'] = $imageURL;
                }


				if($this -> TaiKhoan_model -> create($data)){
					//tạo nội dung thông báo
					$this-> session -> set_flashdata('message','Thêm tài khoản thành công.');
				}
				else{
					$this-> session -> set_flashdata('message','Thêm tài khoản không thành công.');
				}
				//chuyển tới trang  danh sách tài khoản quản trị
				redirect(admin_url('NguoiDung'));
			}
		}
		$this -> data['temp'] = 'admin/nguoidung/add';
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
				$gioiTinh = $this-> input-> post('gioiTinh');

				$data = array(
					'matKhau' => md5($matKhau),
					'hoTen' => $hoTen,
					'imageURL' => $imageURL,
					'gioiTinh' => $gioiTinh
				);	

                //Lấy tên file ảnh được upload lên
                $this -> load -> library('upload_library');
                $upload_path = './upload/img';
                $upload_data =$this -> upload_library -> upload($upload_path, 'image');
                $imageURL = '';
                if(isset($upload_data['file_name']))
                {
                    $imageURL= $upload_data['file_name'];
                    $data['imageURL']= $imageURL;
                    // lấy link hình cũ
                    $imageURL_old='./upload/img/'.$taiKhoan->imageURL;
                }
                
					if($this -> TaiKhoan_model -> update($taiKhoan, $data)){
						//tạo nội dung thông báo
						$this-> session -> set_flashdata('message','Cập nhật tài khoản thành công.');

	                    //Xóa ảnh nghệ sĩ cũ
	                    if(file_exists($imageURL_old)) 
	                    {
	                        unlink($imageURL_old);
	                    }
					}
					else{
						$this-> session -> set_flashdata('message','Cập nhật tài khoản không thành công.');
					}
				//chuyển tới trang  danh sách tài khoản quản trị
				redirect(admin_url('NguoiDung'));		
			}

		}

		$this -> data['temp'] = 'admin/nguoidung/edit';
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
            redirect(admin_url('NguoiDung'));
        }
        //thuc hiện xóa
        $this-> TaiKhoan_model->delete($taiKhoan);
        
        $this-> session->set_flashdata('message', 'Xóa tài khoản thành công.');
        redirect(admin_url('NguoiDung'));
    }



}

?>