<?php 
/**
* 
*/
     $maAlbum ='';  
class Album extends MY_Controller
{   

	
	function __construct()
	{
		parent::__construct();
		$this -> load -> model('Album_model');
        $this -> load -> model('NgheSi_model');
        $this -> load -> model('BaiHat_model');
        $this -> load -> model('Album_BaiHat_model');
	}

	/*
	 * Hiển thị danh sách album
	 */
	function index()
	{

        //Kiểm tra có thực hiện lọc k
        $input['where'] = array();
        $maAlbum = $this->input->get('maAlbum');
        if($maAlbum)
        {
            $input['where']['maAlbum'] = $maAlbum;
        }

        $tenAlbum = $this->input->get('tenAlbum');
        if($tenAlbum)
        {
            $input['like'] = array('tenAlbum', $tenAlbum);
        }

        $maQuocGia = $this->input->get('quocgia');
        if($maQuocGia)
        {
            $input['where']['maQuocGia'] = $maQuocGia;
        }
        //Lấy số lượng album hien thi
        $total_rows = $this -> Album_model-> get_total($input);
        $this -> data['total_rows'] = $total_rows;

        
        //load thư viện phân trang
        $this -> load -> library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;// tổng tất cả bài hát
        $config['base_url']   = admin_url('album/index'); //link hien thi ra danh sach nghe si
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

        //Lấy danh sách quốc gia
        $this-> load-> model('QuocGia_model');
        $quocgia = $this->QuocGia_model->get_list();
        $this->data['quocgia'] = $quocgia;

        //lấy danh sách album
        $list = $this-> Album_model->get_list($input);
        $this->data['list']=$list;

        //lấy danh sách nghệ sĩ album
        $query=$this-> db->query("call sp_Get_Album_NgheSi()");
        mysqli_next_result($this->db->conn_id);
        $this->data['nghesi']=$query->result();        
       
        //lấy nội dung biến message
        $message = $this -> session -> flashdata('message');
        $this -> data['message'] = $message;

        $this -> data['temp'] = 'admin/album/index';
        $this -> load -> view('admin/main-layout', $this->data);

	}
    static $maAlbum_global="";
    //private $maAlbum_global ="";
    function view()
    {
        //Lấy mã album
        
        $str = $this -> uri -> rsegment('3');
        $maAlbum= substr($str,0,10);

        if(empty($maAlbum)) {$maAlbum=$maAlbum_global;}
        else {$maAlbum_global = "2";}

         $this-> session -> set_flashdata('message',$maAlbum.'-'.$maAlbum_global); 


        //if(emty($maAlbum)) $maAlbum=
        //lấy danh sách bài hát
        $this-> db->select('*');
        $this-> db-> from('album_baihat');
        $this-> db-> join('baihat','album_baihat.mabaihat=baihat.mabaihat');
        $this-> db-> where('maAlbum',$maAlbum);

        $query = $this-> db->get();
        
        //Lấy số lượng bài hát
        $total_rows = $query->num_rows();
        $this -> data['total_rows'] = $total_rows;

        //load thư viện phân trang
        $this -> load -> library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;// tổng tất cả bài hát
        $config['base_url']   = admin_url('album/view'); //link hien thi ra danh sach san pham
        $config['per_page']   = 1;//Số lượng bài hát trên 1 trang
        $config['uri_segment'] = 4;//phân đoạn hiển thị số trang trên url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        $config['reuse_query_string']=true;
        $config['prefix'] = $maAlbum.'-' ;

        //khởi tạo các cấu hình trang
        $this->pagination->initialize($config);    
         
        $segment = substr($str, 11,1);
        $segment = intval($segment);

        //$input['limit'] = array($config['per_page'], $segment);

        // Lấy danh sách bài hát thuộc album
        $this-> db->select('*');
        $this-> db-> from('album_baihat');
        $this-> db-> join('baihat','album_baihat.mabaihat=baihat.mabaihat');
        $this-> db-> where('maAlbum',$maAlbum);
        $this-> db-> limit($config['per_page'], $segment);
        $query = $this-> db->get();
        $this->data['list'] = $query->result();

        //lấy danh sách nghệ sĩ album
        $query=$this-> db->query("call sp_Get_Album_NgheSi()");
        mysqli_next_result($this->db->conn_id);
        $this->data['nghesi']=$query->result();

        //lấy thông tin album
        $info= $this->Album_model->get_info($maAlbum);
        $this->data['info']=$info;

        //lấy nội dung biến message
        $message = $this -> session -> flashdata('message');
        $this -> data['message'] = $message;

        $this -> data['temp'] = 'admin/album/view';
        $this -> load -> view('admin/main-layout', $this->data);
    }
    /*
     * Xóa 1 bài hát ra khỏi album
     */
    function del_baihat()
    {
        $str = $this -> uri -> rsegment(3);
        $maalbum = substr($str,0,10);
        $mabaihat = substr($str,11,15);
        $this->_del_baihat($maalbum,$mabaihat);
        $this-> session -> set_flashdata('message','Xóa bài hát thành công'); 
        redirect(admin_url('Album/view/').$maalbum);        
    }
    /*
     * Xóa tất cả bài hát ra khỏi album
     */  
    
    function del_all_baihat()
    {
        $maalbum= $this -> uri -> rsegment(3);
        $ids = $this ->input-> post('ids');
        foreach($ids as $mabaihat)
        {
            $this->_del_baihat($maalbum,$mabaihat);
        }
        $this-> session -> set_flashdata('message','Xóa các bài hát thành công'); 
        redirect(admin_url('Album/view/').$maalbum);     
    }
    /*
     *Xóa bài hát ra khỏi album
     */
    private function _del_baihat($maalbum,$mabaihat)
    {
        $album_baihat = $this -> Album_BaiHat_model-> get_info_mutikey($maalbum,$mabaihat);
        if(!$album_baihat)
        {
            $this-> session -> set_flashdata('message','Không tồn tại bài hát trong album này.'); 
            redirect(admin_url('Album/view/').$maalbum);                   
        } 
        //thực hiện xóa
        $this -> Album_BaiHat_model -> delete_mutikey($maalbum,$mabaihat);

    }

    function add_baihat()
    {
        $this->view();
        //$view_to_add=$this->view_to_add();
        //$this->data['view_to_add']=$view_to_add;
        //Lấy mã album        
        //$maAlbum = $this -> uri -> rsegment('3'); 
        //$this->data['maAlbum']=$maAlbum;

        //Lấy mã album
        
        $str = $this -> uri -> rsegment('3');
        $maAlbum= substr($str,0,10);
        $this->data['maAlbum']=$maAlbum;

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

        //Lấy số lượng bài hát
        $total_rows = $this -> BaiHat_model-> get_total($input);
        $this -> data['total_rows'] = $total_rows;

        //load thư viện phân trang
        $this -> load -> library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;// tổng tất cả bài hát
        $config['base_url']   = admin_url('album/add_baihat'); //link hien thi ra danh sach san pham
        $config['per_page']   = 4;//Số lượng bài hát trên 1 trang
        $config['uri_segment'] = 4;//phân đoạn hiển thị số trang trên url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        $config['reuse_query_string']=true;
        $config['prefix'] = $maAlbum.'-' ;

        //khởi tạo các cấu hình trang
        $this->pagination->initialize($config);    
         
        $segment = substr($str, 11,1);
        $segment = intval($segment);

        $input['limit'] = array($config['per_page'], $segment);
        //lấy danh sách bài hát
        $list = $this-> BaiHat_model->get_list($input);
        //return $list;
        $this->data['list'] = $list;
        
        //Lấy danh sách nghệ sĩ
        $nghesi = $this -> NgheSi_model -> get_list();

        //lấy nội dung biến message
        $message = $this -> session -> flashdata('message');
        $this -> data['message'] = $message;

        $this -> data['temp'] = 'admin/album/add_baihat';
        $this -> load -> view('admin/main-layout', $this->data);
    }

    /*
     * Thêm album mới
     */
    function add()
    {   
        //Lấy danh sách quốc gia
        $this-> load-> model('QuocGia_model');
        $quocgia = $this->QuocGia_model->get_list();
        $this->data['quocgia'] = $quocgia;


        //load thư viện validate dữ liệu
        $this-> load->library('form_validation');
        $this-> load->helper('form');
         date_default_timezone_set('Asia/Ho_Chi_Minh'); 
        // Nếu có dữ liệu post lên
        if($this-> input-> post())
        {

            $this-> form_validation-> set_rules('tenNgheSi','Tên nghệ sĩ','required|max_length[100]');
            $this-> form_validation-> set_rules('quocGia','Quốc gia','required');
            $this-> form_validation-> set_rules('gioiTinh','Giơi tính','required');

            //Nhập liệu chính xác
            if($this -> form_validation -> run())
            {
                $success = $this->db->query("call sp_TaoMa_NgheSi(@outputparam)");
                $query = $this->db->query('select @outputparam as out_param');
                $maNgheSi = $query->row()->out_param;
                $tenNgheSi = $this-> input-> post('tenNgheSi');
                $maQuocGia = $this-> input-> post('quocGia');
                $gioiTinh = $this-> input-> post('gioiTinh');
                $ngaySinh = $this-> input-> post('ngaySinh');
                $tieuSu = $this-> input-> post('tieuSu');

                $this -> load -> library('upload_library');

                $dataNgheSi = array(
                    'maNgheSi' => $maNgheSi,
                    'tenNgheSi' => $tenNgheSi,
                    'maQuocGia' =>$maQuocGia ,
                    'gioiTinh' => $gioiTinh,
                    'ngaySinh' => date("Y-m-d H:i:s",strtotime($ngaySinh)),
                    'tieuSu' => $tieuSu,
                );
        
                //Lấy tên file ảnh được upload lên
                $upload_path = './upload/img';
                $upload_data =$this -> upload_library -> upload($upload_path, 'image');
                $imageURL = '';
                if(isset($upload_data['file_name']))
                {
                    $imageURL= $upload_data['file_name'];
                    $dataNgheSi['imageURL'] = $imageURL;
                }

                

                //Thêm mới vào csdl
                if($this -> NgheSi_model -> create($dataNgheSi)){
                    //tạo nội dung thông báo
                    $this-> session -> set_flashdata('message','Thêm nghệ sĩ thành công.');
                }
                else{
                    $this-> session -> set_flashdata('message','Thêm nghệ sĩ không thành công.');
                }
                redirect(admin_url('nghesi'));
            }
     
        }
        
        
        //load view
        $this->data['temp'] = 'admin/nghesi/add';
        $this->load->view('admin/main-layout', $this->data);
    }
    

    
    /*
     * chỉnh sửa nghệ sĩ
     */
    function edit()
    {
        //Lấy mã nghệ sĩ
        $maNgheSi =$this -> uri -> rsegment('3');   
        $ngheSi = $this -> NgheSi_model -> get_info($maNgheSi);
        if(!$ngheSi)
        {
            $this-> session -> set_flashdata('message','Không tồn tại nghệ sĩ này.'); 
            redirect(admin_url('NgheSi'));                   
        }   
        $this -> data['ngheSi']  = $ngheSi;  

         //Lấy danh sách quốc gia
        $this-> load-> model('QuocGia_model');
        $quocgia = $this->QuocGia_model->get_list();
        $this->data['quocgia'] = $quocgia;


        //load thư viện validate dữ liệu
        $this-> load->library('form_validation');
        $this-> load->helper('form');
         date_default_timezone_set('Asia/Ho_Chi_Minh'); 
        // Nếu có dữ liệu post lên
        if($this-> input-> post())
        {
            $this-> form_validation-> set_rules('tenNgheSi','Tên nghệ sĩ','required|max_length[100]');
            $this-> form_validation-> set_rules('quocGia','Quốc gia','required');
            $this-> form_validation-> set_rules('gioiTinh','Giơi tính','required');
            //$this-> form_validation-> set_rules('ngaySinh','Ngày sinh','required');


            //Nhập liệu chính xác
            if($this -> form_validation -> run())
            {
           
                //Thêm vào csdl
                
                $tenNgheSi = $this-> input-> post('tenNgheSi');
                $maQuocGia = $this-> input-> post('quocGia');
                $gioiTinh = $this-> input-> post('gioiTinh');
                $ngaySinh = $this-> input-> post('ngaySinh');
                $tieuSu = $this-> input-> post('tieuSu');

                $dataNgheSi = array(
                    'tenNgheSi' => $tenNgheSi,
                    'maQuocGia' =>$maQuocGia ,
                    'gioiTinh' => $gioiTinh,
                    'ngaySinh' => date("Y-m-d H:i:s",strtotime($ngaySinh)),
                    'tieuSu' => $tieuSu,
                );

                //Lấy tên file ảnh được upload lên
                $this -> load -> library('upload_library');
                $upload_path = './upload/img';
                $upload_data =$this -> upload_library -> upload($upload_path, 'image');
                $imageURL = '';
                if(isset($upload_data['file_name']))
                {
                    $imageURL= $upload_data['file_name'];
                    $dataNgheSi['imageURL']= $imageURL;
                    // lấy link hình cũ
                    $imageURL_old='./upload/img/'.$ngheSi->imageURL;
                }

                //Cập nhật vào csdl
                if($this -> NgheSi_model -> update($maNgheSi,$dataNgheSi)){
                    //tạo nội dung thông báo
                    $this-> session -> set_flashdata('message','Cập nhật nghệ sĩ thành công.');

                    //Xóa ảnh nghệ sĩ cũ
                    if(file_exists($imageURL_old)) 
                    {
                        unlink($imageURL_old);
                    }
                }
                else{
                    $this-> session -> set_flashdata('message','Cập nhật nghệ sĩ không thành công.');
                }
                //chuyển tới trang  danh sách nghệ sĩ
                redirect(admin_url('nghesi'));
            }
        }
        
        
        //load view
        $this->data['temp'] = 'admin/nghesi/edit';
        $this->load->view('admin/main-layout', $this->data);       
    }
    /*
     * Xóa album
     */
    function del()
    {
        $maNgheSi = $this -> uri -> rsegment(3);
        $this->_del($maNgheSi);
        $this-> session -> set_flashdata('message','Xóa nghệ sĩ thành công'); 
        redirect(admin_url('nghesi'));        
    }

    /*
     * Xóa tất cả nghệ sĩ
     */  
    
    function del_all()
    {
        $ids = $this ->input-> post('ids');
        foreach($ids as $maNgheSi)
        {
            $this -> _del($maNgheSi);
        }

    } 
    /*
     *Xóa nghệ sĩ
     */
    private function _del($maNgheSi)
    {
        $ngheSi = $this -> NgheSi_model-> get_info($maNgheSi);
        if(!$maNgheSi)
        {
            $this-> session -> set_flashdata('message','Không tồn tại nghệ sĩ này.'); 
            redirect(admin_url('nghesi'));                   
        } 
        //thực hiện xóa
        $this -> NgheSi_model -> delete($maNgheSi);
        //Xóa ảnh nghệ sĩ
        $imageURL='./upload/img/'.$nghesi->imageURL;
        if(file_exists($imageURL)) 
        {
            unlink($imageURL);
        }

    }



}

?>