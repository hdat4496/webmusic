<?php 
/**
* 
*/
class ChuDe extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this -> load -> model('ChuDe_model');
		$this -> load -> model('NhomChuDe_model');
	}

	/*
	 * Lấy danh sách chủ đề
	 */
	function index()
	{

		$total_rows = $this -> ChuDe_model-> get_total();
		$this -> data['total_rows'] = $total_rows;

        //load thư viện phân trang
        $this -> load -> library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;// tổng tất cả bài hát
        $config['base_url']   = admin_url('ChuDe/index'); //link hien thi ra danh sach nghe si
        $config['per_page']   = 10;//Số lượng bài hát trên 1 trang
        $config['uri_segment'] = 4;//phân đoạn hiển thị số trang trên url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        $config['reuse_query_string'] = TRUE;

        //khởi tạo các cấu hình trang
        $this-> pagination->initialize($config);    
         
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array($config['per_page'], $segment);

		$total = $this -> ChuDe_model -> get_total($input);
		$this-> data['total'] = $total;

		$list = $this -> ChuDe_model -> get_list($input);
		$this -> data['list'] = $list;


		//lấy nội dung biến message
		$message = $this -> session -> flashdata('message');
		$this -> data['message'] = $message;

		$this -> data['temp'] = 'admin/chude/index';
		$this -> load -> view('admin/main-layout', $this->data);
	}

	/*
	 * Thêm mới chủ đề
	 */
	function add()
	{
		$this -> load -> library('form_validation');
		$this -> load -> helper('form');

		// Nếu có dữ liệu post lên
		if($this-> input-> post())
		{
			$this-> form_validation-> set_rules('tenChuDe','Tên chủ đề','required|max_length[100]');

			//Nhập liệu chính xác
			if($this -> form_validation -> run())
			{
				//Thêm vào csdl
                $success = $this->db->query("call sp_TaoMa_ChuDe(@outputparam)");
                $query = $this->db->query('select @outputparam as out_param');
                $maChuDe = $query->row()->out_param;
				$tenChuDe = $this-> input-> post('tenChuDe');
				$maNhomChuDe = $this-> input-> post('maNhomChuDe');

				$data = array(
					'maChuDe' => $maChuDe,
					'tenChuDe' => $tenChuDe,
					'maNhomChuDe' => $maNhomChuDe
				);

				//Thêm mới vào csdl
				if($this -> ChuDe_model -> create($data)){
					//tạo nội dung thông báo
					$this-> session -> set_flashdata('message','Thêm chủ đề thành công.');
				}
				else{
					$this-> session -> set_flashdata('message','Thêm chủ đề không thành công.');
				}
				//chuyển tới trang  danh sách tài khoản quản trị
				redirect(admin_url('ChuDe'));
			}
		}
        
        //lay danh sach nhóm chủ đề
        $list = $this-> NhomChuDe_model->get_list();
        $this -> data['list'] = $list;		

		$this -> data['temp'] = 'admin/chude/add';
		$this -> load -> view('admin/main-layout', $this->data);
	}


	/*
	 * Cập nhật chủ đề
	 */
	function edit()
	{
		$this -> load -> library('form_validation');
		$this -> load -> helper('form');

		$maChuDe = $this -> uri-> rsegment(3);
		$info = $this-> ChuDe_model ->get_info($maChuDe);
		if(!$info)
		{
			$this-> session -> set_flashdata('message','Không tồn tại chủ đề.');		
			redirect(admin_url('ChuDe'));	
		}

		$this-> data['info']= $info;
 	
		// Nếu có dữ liệu post lên
		if($this-> input-> post())
		{
			$this-> form_validation-> set_rules('tenChuDe','Tên chủ đề','required|max_length[100]');

			//Nhập liệu chính xác
			if($this -> form_validation -> run())
			{
				//Thêm vào csdl

				$tenChuDe = $this-> input-> post('tenChuDe');
				$maNhomChuDe = $this-> input-> post('maNhomChuDe');

				$data = array(
					'tenChuDe' => $tenChuDe,
					'maNhomChuDe' => $maNhomChuDe
				);

				//cập nhật vào csdl
				if($this -> ChuDe_model -> update($maChuDe,$data)){
					//tạo nội dung thông báo
					$this-> session -> set_flashdata('message','Cập  nhât chủ đề thành công.');
				}
				else{
					$this-> session -> set_flashdata('message','Cập nhật chủ đề không thành công.');
				}
				//chuyển tới trang  danh sách chủ đề
				redirect(admin_url('ChuDe'));
			}
		}
        
        //lay danh sach nhóm chủ đề
        $list = $this-> NhomChuDe_model->get_list();
        $this -> data['list'] = $list;		

		$this -> data['temp'] = 'admin/chude/edit';
		$this -> load -> view('admin/main-layout', $this->data);
	}

    
    /*
     * Hàm xóa dữ liệu
     */
    function delete()
    {
        $maChuDe = $this->uri->rsegment('3');
        $this -> _del($maChuDe);

        $this-> session->set_flashdata('message', 'Xóa chủ đề thành công.');
        redirect(admin_url('ChuDe'));
    }
    /*
     * Xóa tất chủ đề
     */  
    
    function del_all()
    {
        $ids = $this ->input-> post('ids');
        foreach($ids as $maChuDe)
        {
            $this -> _del($maChuDe);
        }

    } 
    /*
     *Xoa chủ đề
     */
    private function _del($maChuDe)
    {
        //lay thong tin chủ dề
		$info = $this-> ChuDe_model ->get_info($maChuDe);
        if(!$info)
        {
            $this-> session->set_flashdata('message', 'Không tồn tại chủ đề này.');
            redirect(admin_url('ChuDe'));
        }

        //thuc hiện xóa
        $this-> ChuDe_model->delete($maChuDe);
        
        
    }
}

 ?>