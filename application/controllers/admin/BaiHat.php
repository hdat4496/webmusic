<?php 
/**
* 
*/
class BaiHat extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this -> load -> model('BaiHat_model');
	}

	/*
	 * Hiển thị danh sách bài hát
	 */
	function index()
	{
		//Lấy số lượng bài hát
		$total_rows = $this -> BaiHat_model-> get_total();
		$this -> data['total_rows'] = $total_rows;

		//load thư viện phân trang
		$this -> load -> library('pagination');
		$config = array();
		$config['total_rows'] = $total_rows;// tổng tất cả bài hát
        $config['base_url']   = admin_url('baihat/index'); //link hien thi ra danh sach san pham
        $config['per_page']   = 10;//Số lượng bài hát trên 1 trang
        $config['uri_segment'] = 4;//phân đoạn hiển thị số trang trên url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';

        //khởi tạo các cấu hình trang
        $this->pagination->initialize($config);    
         
        $segment = $this->uri->segment(4);
        $segment = intval($segment);

        $input = array();
        $input['limit'] = array($config['per_page'], $segment);

        //Kiểm tra có thực hiện lọc k
        $input['where'] = array();
        $maBaiHat = $this->input->get('maBaiHat');
        if($maBaiHat)
        {
            $input['where']['maBaiHat'] = $maBaiHat;
        }

        $tenBaiHat = $this->input->get('tenBaiHat');
        if($tenBaiHat)
        {
            $input['like'] = array('tenBaiHat', $tenBaiHat);
        }



        //lấy danh sách bài hát
        $list = $this-> BaiHat_model->get_list($input);
        $this->data['list'] = $list;
       
       
        //Lấy danh sách chủ đề
        $this-> load-> model('ChuDe_model');
        $chude = $this->ChuDe_model->get_list();
        $this->data['chude'] = $chude;

		//lấy nội dung biến message
		$message = $this -> session -> flashdata('message');
		$this -> data['message'] = $message;

		$this -> data['temp'] = 'admin/baihat/index';
		$this -> load -> view('admin/main-layout', $this->data);
	}


}

?>