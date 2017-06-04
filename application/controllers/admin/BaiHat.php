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
        $this -> load -> model ('BaiHatChuDe_model');
        $this -> load -> model('SangTac_model');
        $this -> load -> model('TrinhBay_model');
        $this -> load -> model('NgheSi_model');
     
	}

	/*
	 * Hiển thị danh sách bài hát
	 */
	function index()
	{

        //Kiểm tra có thực hiện lọc k
        $input['where'] = array();
        $maBaiHat = $this->input->get('maBaiHat');
        if($maBaiHat)
        {
            $input['like'] = array('maBaiHat', $maBaiHat);
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
        //Lấy số lượng bài hát
        $total_rows = $this -> BaiHat_model-> get_total($input);
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


        //lấy danh sách bài hát
        $list = $this-> BaiHat_model->get_list($input);
        $this->data['list'] = $list;
        
        //Lấy danh sách nghệ sĩ
        $nghesi = $this -> NgheSi_model -> get_list();

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

        //load thư viện validate dữ liệu
        $this-> load->library('form_validation');
        $this-> load->helper('form');
         date_default_timezone_set('Asia/Ho_Chi_Minh'); 
        // Nếu có dữ liệu post lên
        if($this-> input-> post())
        {

            $this-> form_validation-> set_rules('tenBaiHat','Tên bài hát','required|max_length[100]');
            $this-> form_validation-> set_rules('quocGia','Quốc gia','required');

            //Nhập liệu chính xác
            if($this -> form_validation -> run())
            {
                //Thêm vào csdl
                $success = $this->db->query("call sp_TaoMa_BaiHat(@outputparam)");
                $query = $this->db->query('select @outputparam as out_param');
                $maBaiHat = $query->row()->out_param;
                
                $tenBaiHat = $this-> input-> post('tenBaiHat');
                $maQuocGia = $this-> input-> post('quocGia');
                $loiBaiHat = $this-> input-> post('loiBaiHat');

                $this -> load -> library('upload_library');
                $ngayPhatHanh=date('Y-m-d H:i:s');

                $dataBaiHat = array(
                    'maBaiHat' => $maBaiHat,
                    'tenBaiHat' =>$tenBaiHat,
                    'maQuocGia' =>$maQuocGia ,
                    'loiBaiHat' =>$loiBaiHat ,
                    'luotNghe' => 0 ,
                    'luotThich' => 0,
                    'luotTai' => 0,
                    'ngayPhatHanh' => $ngayPhatHanh
                );

                //Lấy tên file nhạc được upload lên
                $upload_path_audio = './upload/music';
                $upload_data_audio =$this -> upload_library -> upload($upload_path_audio, 'audio');
                $url = '';
                if(isset($upload_data_audio['file_name']))
                {
                    $url= $upload_data_audio['file_name'];
                    $dataBaiHat['url'] = $url;
                }


                //Lấy tên file nhạc được upload lên                
                $upload_path = './upload/img';
                $upload_data =$this -> upload_library -> upload($upload_path, 'image');
                $imageURL = '';
                if(isset($upload_data['file_name']))
                {
                    $imageURL= $upload_data['file_name'];
                    $dataBaiHat['imageURL'] = $imageURL;
                }
                //Thêm mới vào csdl
                if($this -> BaiHat_model -> create($dataBaiHat)){
                    //tạo nội dung thông báo
                    $this-> session -> set_flashdata('message','Thêm bài hát thành công.');
                    redirect(admin_url('BaiHat/chitiet/').$maBaiHat);
                }
                else{
                    $this-> session -> set_flashdata('message','Thêm bài hát không thành công.');
                    redirect(admin_url('BaiHat'));
                }

            }
     
        }
        
        //load view
        $this->data['temp'] = 'admin/baihat/add';
        $this->load->view('admin/main-layout', $this->data);
    }
    

    /*
     * chỉnh sửa bài hát
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
         date_default_timezone_set('Asia/Ho_Chi_Minh'); 

        $this -> load -> library('form_validation');
        $this -> load -> helper('form');        
        // Nếu có dữ liệu post lên
        if($this-> input-> post())
        {
            $this-> form_validation-> set_rules('tenBaiHat','Tên bài hát','required|max_length[100]');
            $this-> form_validation-> set_rules('quocGia','Quốc gia','required');


            //Nhập liệu chính xác
            if($this -> form_validation -> run())
            {
           
                //Thêm vào csdl
                $tenBaiHat = $this-> input-> post('tenBaiHat');
                $maQuocGia = $this-> input-> post('quocGia');
                $loiBaiHat = $this-> input-> post('loiBaiHat');

               $this -> load -> library('upload_library');
                $dataBaiHat = array(
                    'tenBaiHat' =>$tenBaiHat,
                    'maQuocGia' =>$maQuocGia ,
                    'loiBaiHat' =>$loiBaiHat 
                );

               // Lấy tên file nhạc được upload lên
                $upload_path_audio = './upload/music';
                $upload_data_audio =$this -> upload_library -> upload($upload_path_audio, 'audio');
                $url = '';
                if(isset($upload_data_audio['file_name']))
                {
                    $url= $upload_data_audio['file_name'];
                    $dataBaiHat['url']= $url;
                    // lấy link hình cũ
                    $url_old='./upload/music/'.$baiHat->url;
                }

                //Lấy tên file nhạc được upload lên
                $upload_path = './upload/img';
                $upload_data =$this -> upload_library -> upload($upload_path, 'image');
                $imageURL = '';
                if(isset($upload_data['file_name']))
                {
                    $imageURL= $upload_data['file_name'];
                    $dataNgheSi['imageURL']= $imageURL;
                    // lấy link hình cũ
                    $imageURL_old='./upload/img/'.$baiHat->imageURL;
                }

                //cập nhật vào csdl
                if($this -> BaiHat_model -> update($maBaiHat,$dataBaiHat)){
                    //tạo nội dung thông báo
                    $this-> session -> set_flashdata('message','Cập  nhât chủ đề thành công.');
                    //Xóa ảnh bài hát cũ
                    if(file_exists($imageURL_old)) 
                    {
                        unlink($imageURL_old);
                    }

                    //Xóa audio bài hát cũ
                    if(file_exists($url_old)) 
                    {
                        unlink($url_old);
                    }
                }
                else{
                    $this-> session -> set_flashdata('message','Cập nhật chủ đề không thành công.');
                }
                //chuyển tới trang  danh sách chủ đề
                redirect(admin_url('BaiHat'));
            }
        }
        
        
        //load view
        $this->data['temp'] = 'admin/baihat/edit';
        $this->load->view('admin/main-layout', $this->data);       
    }


    function chitiet()
    {   

        //Lấy mã bài hát
        $maBaiHat =$this -> uri -> rsegment('3');   
        $baiHat = $this -> BaiHat_model -> get_info( $maBaiHat);
        if(!$baiHat)
        {
            $this-> session -> set_flashdata('message','Không tồn tại bài hát này.'); 
            redirect(admin_url('BaiHat'));                   
        }   

        $this -> data['baiHat']  = $baiHat;  

        //Lấy danh sách nghệ sĩ
        $this-> load-> model('NgheSi_model');
        $nghesi = $this->NgheSi_model->get_list();
        $this->data['nghesi'] = $nghesi;

        //Lấy danh sách chủ đề
        $this-> load-> model('ChuDe_model');
        $chude = $this->ChuDe_model->get_list();
        $this->data['chude'] = $chude;

       // load view
        $this->data['temp'] = 'admin/baihat/chitiet';
        $this->load->view('admin/main-layout', $this->data);

    }

    function chitiet_edit()
    {   

        //Lấy mã bài hát
        $maBaiHat =$this -> uri -> rsegment('3');   
        $baiHat = $this -> BaiHat_model -> get_info( $maBaiHat);
        if(!$baiHat)
        {
            $this-> session -> set_flashdata('message','Không tồn tại bài hát này.'); 
            redirect(admin_url('BaiHat'));                   
        }   

        $this -> data['baiHat']  = $baiHat;  

        //Lấy danh sách nghệ sĩ
        $this-> load-> model('NgheSi_model');
        $nghesi = $this->NgheSi_model->get_list();
        $this->data['nghesi'] = $nghesi;

        //Lấy danh sách chủ đề
        $this-> load-> model('ChuDe_model');
        $chude = $this->ChuDe_model->get_list();
        $this->data['chude'] = $chude;

       // load view
        $this->data['temp'] = 'admin/baihat/chitiet_edit';
        $this->load->view('admin/main-layout', $this->data);

    }

    function them_chitiet()
    { 

         //dữ liệu post lên   
        $data = $_POST;
        $x=0;
        foreach ($data['list_chude'] as $key => $value) {
                $data_chude = array(
                    'maBaiHat' => $data['mabaihat'],
                    'maChuDe' => $value["machude"]
                );
                //Thêm mới vào csdl
                if($this -> BaiHatChuDe_model -> create($data_chude)){
                    $x++;
                } else{
                    $x--;               
                }
        }        

        foreach ($data['list_nhacsi'] as $key => $value) {
                $data_sangtac = array(
                    'maBaiHat' => $data['mabaihat'],
                    'maNhacSi' => $value["manhacsi"]
                );
                //Thêm mới vào csdl
                if($this -> SangTac_model -> create($data_sangtac)){
                    $x++;
                } else{
                    $x--;               
                }
        }  

        foreach ($data['list_casi'] as $key => $value) {
                $data_trinhbay = array(
                    'maBaiHat' => $data['mabaihat'],
                    'maCasi' => $value["macasi"]
                );
                //Thêm mới vào csdl
                if($this -> TrinhBay_model -> create($data_trinhbay)){
                    $x++;
                } else{
                    $x--;               
                }
        }  
        echo $x;
}

    function sua_chitiet()
    { 

         //dữ liệu post lên   
        $data = $_POST;
        $x=0;

        $chude = $this-> BaiHat_model->layDSChuDeBaiHat($data['mabaihat']);        
        $casi = $this-> BaiHat_model->layDSCaSiBaiHat($data['mabaihat']);       
        $nhacsi = $this-> BaiHat_model->layDSNhacSiBaiHat($data['mabaihat']);

        foreach ($chude as $key => $value) {
            $this -> BaiHatChuDe_model -> delete($data['mabaihat'],$value["maChuDe"]);
        }

        foreach ($casi as $key => $value) {
            $this -> TrinhBay_model-> delete($data['mabaihat'],$value["maNgheSi"]);
        }

        foreach ($nhacsi as $key => $value) {
            $this -> SangTac_model -> delete($data['mabaihat'],$value["maNgheSi"]);
        }

        foreach ($data['list_chude'] as $key => $value) {
                $data_chude = array(
                    'maBaiHat' => $data['mabaihat'],
                    'maChuDe' => $value["machude"]
                );
                //Thêm mới vào csdl
                if($this -> BaiHatChuDe_model -> create($data_chude)){
                    $x++;
                } else{
                    $x--;               
                }
        }        

        foreach ($data['list_nhacsi'] as $key => $value) {
                $data_sangtac = array(
                    'maBaiHat' => $data['mabaihat'],
                    'maNhacSi' => $value["manhacsi"]
                );
                //Thêm mới vào csdl
                if($this -> SangTac_model -> create($data_sangtac)){
                    $x++;
                } else{
                    $x--;               
                }
        }  

        foreach ($data['list_casi'] as $key => $value) {
                $data_trinhbay = array(
                    'maBaiHat' => $data['mabaihat'],
                    'maCasi' => $value["macasi"]
                );
                //Thêm mới vào csdl
                if($this -> TrinhBay_model -> create($data_trinhbay)){
                    $x++;
                } else{
                    $x--;               
                }
        }  
        echo $x;
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