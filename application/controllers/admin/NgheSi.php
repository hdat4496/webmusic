<?php 
/**
* 
*/
     $maNgheSi ='';  
class NgheSi extends MY_Controller
{   

	
	function __construct()
	{
		parent::__construct();
		$this -> load -> model('NgheSi_model');
	}

	/*
	 * Hiển thị danh sách nghệ sĩ
	 */
	function index()
	{
        //Kiểm tra có thực hiện lọc k
        $input['where'] = array();
        $maNgheSi = $this->input->get('maNgheSi');
        if($maNgheSi)
        {
            $input['where']['maNgheSi'] = $maNgheSi;
        }
      $segment = $this->uri->segment(4);
      pre($segment);
        $tenNgheSi = $this->input->get('tenNgheSi');
        if($tenNgheSi)
        {
            $input['like'] = array('tenNgheSi', $tenNgheSi);
        }

        $maQuocGia = $this->input->get('quocgia');
        if($maQuocGia)
        {
            $input['where']['maQuocGia'] = $maQuocGia;
        }
        //Lấy số lượng nghe si hien thi
        $total_rows = $this -> NgheSi_model-> get_total($input);
        $this -> data['total_rows'] = $total_rows;

        
        //load thư viện phân trang
        $this -> load -> library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;// tổng tất cả bài hát
        $config['base_url']   = admin_url('NgheSi/index'); //link hien thi ra danh sach nghe si
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

        //lấy danh sách nghe si
        $list = $this-> NgheSi_model->get_list($input);
        $this->data['list'] = $list;
       
       
        //lấy nội dung biến message
        $message = $this -> session -> flashdata('message');
        $this -> data['message'] = $message;

        $this -> data['temp'] = 'admin/nghesi/index';
        $this -> load -> view('admin/main-layout', $this->data);

	}

    /*
     * Thêm nghệ sĩ mới
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
     * Xóa nghệ sĩ
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