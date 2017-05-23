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
		$list = $this -> ChuDe_model -> get_list();
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
				//$maChuDe = ;
				$tenChuDe = $this-> input-> post('tenChuDe');
				$maNhomChuDe = $this-> input-> post('maNhomChuDe');

				$data = array(
					'maChuDe' => 'CD00024',
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

		$this->data['info']= $info;
 	
		// Nếu có dữ liệu post lên
		if($this-> input-> post())
		{
			$this-> form_validation-> set_rules('tenChuDe','Tên chủ đề','required|max_length[100]');

			//Nhập liệu chính xác
			if($this -> form_validation -> run())
			{
				//Thêm vào csdl
				//$maChuDe = ;
				$tenChuDe = $this-> input-> post('tenChuDe');
				$maNhomChuDe = $this-> input-> post('maNhomChuDe');

				$data = array(
					'tenChuDe' => $tenChuDe,
					'maNhomChuDe' => $maNhomChuDe
				);

				//Thêm mới vào csdl
				if($this -> ChuDe_model -> update($maChuDe,$data)){
					//tạo nội dung thông báo
					$this-> session -> set_flashdata('message','Cập  nhât chủ đề thành công.');
				}
				else{
					$this-> session -> set_flashdata('message','Cập nhật chủ đề không thành công.');
				}
				//chuyển tới trang  danh sách tài khoản quản trị
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