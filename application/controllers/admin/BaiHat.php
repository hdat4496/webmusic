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

        $maQuocGia = $this->input->get('quocgia');
        if($maQuocGia)
        {
            $input['where']['maQuocGia'] = $maQuocGia;
        }

        //lấy danh sách bài hát
        $list = $this-> BaiHat_model->get_list($input);
        $this->data['list'] = $list;
       
       
        //Lấy danh sách quốc gia
        $this-> load-> model('QuocGia_model');
        $quocgia = $this->QuocGia_model->get_list();
        $this->data['quocgia'] = $quocgia;

		//lấy nội dung biến message
		$message = $this -> session -> flashdata('message');
		$this -> data['message'] = $message;

		$this -> data['temp'] = 'admin/baihat/index';
		$this -> load -> view('admin/main-layout', $this->data);
	}

    /*
     * Thêm bài hát mới
     */
    function add()
    {
      
        //Lấy danh sách quốc gia
        $this-> load-> model('QuocGia_model');
        $quocgia = $this->QuocGia_model->get_list();
        $this->data['quocgia'] = $quocgia;

        //Lấy danh sách nghệ sĩ
        $this-> load-> model('NgheSi_model');
        $nghesi = $this->NgheSi_model->get_list();
        $this->data['nghesi'] = $nghesi;

        //Lấy danh sách chủ đề
        $this-> load-> model('ChuDe_model');
        $chude = $this->ChuDe_model->get_list();
        $this->data['chude'] = $chude;

        //load thư viện validate dữ liệu
        $this-> load->library('form_validation');
        $this-> load->helper('form');
         date_default_timezone_set('Asia/Ho_Chi_Minh'); 
        // Nếu có dữ liệu post lên
        if($this-> input-> post())
        {

            $this-> form_validation-> set_rules('tenBaiHat','Tên bài hát','required|max_length[100]');
            $this-> form_validation-> set_rules('quocGia','Quốc gia','required');
            $this-> form_validation-> set_rules('chuDe','Tên chủ đề','required');
            $this-> form_validation-> set_rules('sangTac','Sáng tác','required');
            $this-> form_validation-> set_rules('trinhBay','Trình bày','required');

            //Nhập liệu chính xác
            if($this -> form_validation -> run())
            {

                //Thêm vào csdl
                //$mabaihat = ;
                $tenBaiHat = $this-> input-> post('tenBaiHat');
                $maQuocGia = $this-> input-> post('quocGia');
                $maChuDe = $this-> input-> post('chuDe');
                $maNSSangTac = $this-> input-> post('sangTac');
                $maNSTrinhBay = $this-> input-> post('trinhBay');
                $loiBaiHat = $this-> input-> post('loiBaiHat');

                $this -> load -> library('upload_library');
                //Lấy tên file nhạc được upload lên
                $upload_path_audio = './upload/music';
                $upload_data_audio =$this -> upload_library -> upload($upload_path_audio, 'audio');
                $url = '';
                if(isset($upload_data_audio['file_name']))
                {
                    $url= $upload_data_audio['file_name'];
                }


                //Lấy tên file nhạc được upload lên
                $upload_path = './upload/img';
                $upload_data =$this -> upload_library -> upload($upload_path, 'image');
                $imageURL = '';
                if(isset($upload_data['file_name']))
                {
                    $imageURL= $upload_data['file_name'];
                }

                $ngayPhatHanh=date('Y-m-d H:i:s');
                $dataBaiHat = array(
                    'maBaiHat' => 'BH0000000000078',
                    'url' => $url,
                    'tenBaiHat' =>$tenBaiHat,
                    'imageURL' =>$imageURL ,
                    'maQuocGia' =>$maQuocGia ,
                    'loiBaiHat' =>$loiBaiHat ,
                    'luotNghe' => 0 ,
                    'luotThich' => 0,
                    'luotTai' => 0,
                    'ngayPhatHanh' => $ngayPhatHanh
                );



                //Thêm mới vào csdl
                if($this -> BaiHat_model -> create($dataBaiHat)){
                    //tạo nội dung thông báo
                    $this-> session -> set_flashdata('message','Thêm bài hát thành công.');
                }
                else{
                    $this-> session -> set_flashdata('message','Thêm bài hát không thành công.');
                }
                //chuyển tới trang  danh sách tài khoản quản trị
                redirect(admin_url('BaiHat'));
            }
     
        }
        
        
        //load view
        $this->data['temp'] = 'admin/baihat/add';
        $this->load->view('admin/main-layout', $this->data);
    }
    
    /*
     * chỉnh sửa bài hát mới
     */
    function edit()
    {
        //Lấy mã bài hát
        $maBaiHat =$this -> uri -> rsegment('3');   
        $baiHat = $this -> BaiHat_model -> get_info($maBaiHat);
        if(!$baiHat)
        {
            $this-> session -> set_flashdata('message','Không tồn tại bài hát này.'); 
            redirect(admin_url('BaiHat'));                   
        }   
        $this -> data['baiHat']  = $baiHat;  

         //Lấy danh sách quốc gia
        $this-> load-> model('QuocGia_model');
        $quocgia = $this->QuocGia_model->get_list();
        $this->data['quocgia'] = $quocgia;

        //Lấy danh sách nghệ sĩ
        $this-> load-> model('NgheSi_model');
        $nghesi = $this->NgheSi_model->get_list();
        $this->data['nghesi'] = $nghesi;

        //Lấy danh sách chủ đề
        $this-> load-> model('ChuDe_model');
        $chude = $this->ChuDe_model->get_list();
        $this->data['chude'] = $chude;

        //load thư viện validate dữ liệu
        $this-> load->library('form_validation');
        $this-> load->helper('form');
         date_default_timezone_set('Asia/Ho_Chi_Minh'); 
        // Nếu có dữ liệu post lên
        if($this-> input-> post())
        {
            $this-> form_validation-> set_rules('tenBaiHat','Tên bài hát','required|max_length[100]');
            $this-> form_validation-> set_rules('quocGia','Quốc gia','required');
            $this-> form_validation-> set_rules('chuDe','Tên chủ đề','required');
            $this-> form_validation-> set_rules('sangTac','Sáng tác','required');
            $this-> form_validation-> set_rules('trinhBay','Trình bày','required');


            //Nhập liệu chính xác
            if($this -> form_validation -> run())
            {
           
                //Thêm vào csdl
                //$mabaihat = ;
                $tenBaiHat = $this-> input-> post('tenBaiHat');
                $maQuocGia = $this-> input-> post('quocGia');
                $maChuDe = $this-> input-> post('chuDe');
                $maNSSangTac = $this-> input-> post('sangTac');
                $maNSTrinhBay = $this-> input-> post('trinhBay');
                $loiBaiHat = $this-> input-> post('loiBaiHat');

                //Lấy tên file ảnh được upload lên
                $this -> load -> library('upload_library');
                $upload_path = './upload/img';
                $upload_data =$this -> upload_library -> upload($upload_path, 'image');
                $imageURL = '';
                if(isset($upload_data['file_name']))
                {
                    $imageURL= $upload_data['file_name'];
                }
                $ngayPhatHanh=date('Y-m-d H:i:s');
                $dataBaiHat = array(
                    'maBaiHat' => 'BH0000000000042',
                    'url' => '123123',
                    'tenBaiHat' =>$tenBaiHat,
                    'imageURL' =>$imageURL ,
                    'maQuocGia' =>$maQuocGia ,
                    'loiBaiHat' =>$loiBaiHat ,
                    'luotNghe' => 0 ,
                    'luotThich' => 0,
                    'luotTai' => 0,
                    'ngayPhatHanh' => $ngayPhatHanh
                );



                //Thêm mới vào csdl
                if($this -> BaiHat_model -> update($baiHat->maBaiHat,$dataBaiHat)){
                    //tạo nội dung thông báo
                    $this-> session -> set_flashdata('message','Thêm bài hát thành công.');
                }
                else{
                    $this-> session -> set_flashdata('message','Thêm bài hát không thành công.');
                }
                //chuyển tới trang  danh sách tài khoản quản trị
                redirect(admin_url('BaiHat'));
            }
        }
        
        
        //load view
        $this->data['temp'] = 'admin/baihat/edit';
        $this->load->view('admin/main-layout', $this->data);       
    }
    /*
     * Xóa bài hát
     */
    function del()
    {
        $maBaiHat = $this -> uri -> rsegment(3);
        $this->_del($maBaiHat);
        $this-> session -> set_flashdata('message','Xóa bài hát thành công'); 
        redirect(admin_url('BaiHat'));        
    }

    /*
     * Xóa tất cả bài hát
     */  
    
    function del_all()
    {
        $ids = $this ->input-> post('ids');
        foreach($ids as $maBaiHat)
        {
            $this -> _del($maBaiHat);
        }

    } 
    /*
     *Xóa bài hát
     */
    private function _del($maBaiHat)
    {
        $baiHat = $this -> BaiHat_model-> get_info($maBaiHat);
        if(!$baiHat)
        {
            $this-> session -> set_flashdata('message','Không tồn tại bài hát này.'); 
            redirect(admin_url('BaiHat'));                   
        } 
        //thực hiện xóa
        $this -> BaiHat_model -> delete($maBaiHat);
        //Xóa ảnh bài hát
        $imageURL='./upload/img/'.$baiHat->imageURL;
        if(file_exists($imageURL)) 
        {
            unlink($imageURL);
        }

        //Xóa file audio bài hát
        $url='./upload/music/'.$baiHat->url;
        if(file_exists($url)) 
        {
            unlink($url);
        }
    }
 
}

?>