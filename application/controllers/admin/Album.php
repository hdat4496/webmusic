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
        $this -> load -> model('ChuDe_model');
        $this -> load -> model('Album_BaiHat_model');
         $this -> load -> model('Album_ChuDe_model');
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

        //lấy danh sách chủ đề của album
        $this-> db->select('*');
        $this-> db-> from('album_chude');
        $this-> db-> join('chude','album_chude.machude=chude.machude');
        $query= $this-> db-> get();
        $listCD= $query->result();    
        $this-> data['listCD']=$listCD;
       
        //lấy nội dung biến message
        $message = $this -> session -> flashdata('message');
        $this -> data['message'] = $message;

        $this -> data['temp'] = 'admin/album/index';
        $this -> load -> view('admin/main-layout', $this->data);

	}
    
    function view()
    {
        //Lấy mã album
        $str = $this -> uri -> rsegment('3');
        $maAlbum= substr($str,0,10);

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
        $config['per_page']   = 7;//Số lượng bài hát trên 1 trang
        $config['uri_segment'] = 4;//phân đoạn hiển thị số trang trên url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        $config['reuse_query_string']=true;
        $config['prefix'] = $maAlbum.'-' ;
        $config['first_url'] = admin_url('Album/view/').$maAlbum;

        //khởi tạo các cấu hình trang
        $this-> pagination->initialize($config);    
         
        $index=strpos($str,'-');
        $segment = substr($str, $index+1);
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

        //lấy danh sách chủ đề thuộc album
        $this-> db->select('*');
        $this-> db-> from('album_chude');
        $this-> db-> join('chude','album_chude.machude=chude.machude');
        $this-> db-> where('maAlbum',$maAlbum);
        $query= $this-> db-> get();
        $chude= $query->result();
        $this->data['chude']=$chude;

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
        redirect(admin_url('album/view/').$maalbum);        
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
            //$this->_del_baihat($maalbum,$mabaihat);
            $this -> Album_BaiHat_model -> delete_mutikey($maalbum,$mabaihat);
        }
        $this-> session -> set_flashdata('message','Xóa các bài hát thành công'); 
        //redirect(admin_url('album/view/').$maAlbum);
        redirect(admin_url('album/view/').$maalbum);
           
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
            redirect(admin_url('album/view/').$maalbum);                   
        } 
        //thực hiện xóa
        $this -> Album_BaiHat_model -> delete_mutikey($maalbum,$mabaihat);

    }

    private function removeElementWithValue($array, $key, $value){
        foreach($array as $subKey => $subArray){
            if($subArray->$key == $value){
            unset($array[$subKey]);
            }
        }
     return $array;
    }

    function add_baihat()
    {
        //$this->view();
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

        //lấy danh sách bài hát
        $list = $this-> BaiHat_model->get_list($input);

        //lấy danh sách bài hát thuộc album
        $this-> db->select('*');
        $this-> db-> from('album_baihat');
        $this-> db-> join('baihat','album_baihat.mabaihat=baihat.mabaihat');
        $this-> db-> where('maAlbum',$maAlbum);
        $query= $this-> db-> get();
        $listBH= $query->result();
        
        //xử lý xóa các bài hát đã thuộc album ra khỏi danh sách list
        foreach ($list as $row)
        {
            foreach ($listBH as $bh){
                if($row->maBaiHat == $bh->maBaiHat)
                {
                    $list=$this->removeElementWithValue($list,'maBaiHat',$bh->maBaiHat);
                    break;
                }
                # code...
            }
        }
        //Lấy số lượng bài hát
        $total_rows = count($list);
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
        $config['first_url'] = admin_url('album/add_baihat/').$maAlbum;

        //khởi tạo các cấu hình trang
        $this->pagination->initialize($config);    
         
        $index=strpos($str,'-');
        $segment = substr($str, $index+1);
        $segment = intval($segment);

        $input['limit'] = array($config['per_page'], $segment);

        $this->data['list'] = array_slice($list, $segment,$config['per_page']);
        
        //Lấy danh sách quốc gia
        $this-> load-> model('QuocGia_model');
        $quocgia = $this->QuocGia_model->get_list();
        $this->data['quocgia'] = $quocgia;
        

        //lấy nội dung biến message
        $message = $this -> session -> flashdata('message');
        $this -> data['message'] = $message;

        $this -> data['temp'] = 'admin/album/add_baihat';
        $this -> load -> view('admin/main-layout', $this->data);
    }

      /*
     * Thêm bài hát vào album
     */
    function add_baihat_to_album()
    {   
        $str=$this-> uri->rsegment(3);
        $maAlbum= substr($str,0,10);
        $maBaiHat= substr($str,11,15);
        $data= array(
            'maAlbum' => $maAlbum,
            'maBaiHat' => $maBaiHat);

        if($this -> Album_BaiHat_model -> create($data)){
                    //tạo nội dung thông báo
                    $this-> session -> set_flashdata('message','Thêm bài hát vào album thành công.');
        }
        else{
                    $this-> session -> set_flashdata('message','Thêm bài hát vào album không thành công.');
        }
        redirect(admin_url('album/view/').$maAlbum);
    }
    /*
     * Xóa tất cả nghệ sĩ
     */  
    
    function add_all_baihat_to_album()
    {
        $maAlbum=$this-> uri->rsegment(3);
        $ids = $this ->input-> post('ids');
        $data= array('maAlbum' => $maAlbum);
        foreach($ids as $maBaiHat)
        {
            $data['maBaiHat']=$maBaiHat;
            $this-> Album_BaiHat_model->create($data);
        }
    } 
    /*
     * Thêm album mới
     */
    function load_add()
    {   
        //Lấy danh sách quốc gia
        $this-> load-> model('QuocGia_model');
        $quocgia = $this->QuocGia_model->get_list();
        $this->data['quocgia'] = $quocgia;

        //lấy danh sách chủ đề
        $listCD = $this-> ChuDe_model->get_list();
        $this->data['chude']=$listCD;

        //load thư viện validate dữ liệu
        $this-> load->library('form_validation');
        $this-> load->helper('form');
         date_default_timezone_set('Asia/Ho_Chi_Minh'); 
        
        //load view
        $this->data['temp'] = 'admin/album/add';
        $this->load->view('admin/main-layout', $this->data);
    }
    
    function add()
    {
            if(!empty($_POST['tenAlbum']) && !empty($_POST['maQuocGia']) && !empty($_POST['list_chude']))
            {
                $dataPost= $_POST;
                $success = $this->db->query("call sp_TaoMa_Album(@outputparam)");
                $query = $this->db->query('select @outputparam as out_param');
                $maAlbum = $query->row()->out_param;
                //$tenAlbum = $this-> input-> post('tenAlbum');
                //$maQuocGia = $this-> input-> post('quocGia');
                $tenAlbum = $dataPost['tenAlbum'];
                $maQuocGia = $dataPost['maQuocGia'];
                
                $this -> load -> library('upload_library');

                $data = array(
                    'maAlbum' => $maAlbum,
                    'tenAlbum' => $tenAlbum,
                    'maQuocGia' =>$maQuocGia ,
                    'ngayTao' => date("Y-m-d H:i:s")
                );

                //Thêm mới vào csdl
                if($this -> Album_model -> create($data)){
                    $dataChuDe= array('maAlbum' => $maAlbum);
                    foreach ($dataPost['list_chude'] as $key => $value) {
                        $dataChuDe['maChuDe']= $value["machude"];
                        //pre($dataChuDe);
                        $this-> Album_ChuDe_model-> create($dataChuDe);
                    }
                    //tạo nội dung thông báo
                    $this-> session -> set_flashdata('message','Thêm album thành công.');
                    //redirect(admin_url('album/add_baihat/').$maAlbum);
                }
                else{
                    $this-> session -> set_flashdata('message','Thêm album không thành công.');
                }
                
            //}
            echo $maAlbum;
            }
        }
    function add_image()
    {
        $maAlbum = $this-> uri-> rsegment(3);
        $this-> data['maAlbum']= $maAlbum;
        $this->data['temp'] = 'admin/album/add_image';
        $this->load->view('admin/main-layout', $this->data);
    } 
      function add_image_perform()
    {
                $this -> load -> library('upload_library');
                $upload_path = './upload/img';
                $upload_data =$this -> upload_library -> upload($upload_path, 'image');
                $imageURL = '';
                if(isset($upload_data['file_name']))
                {
                    $imageURL= $upload_data['file_name'];
                    $data['imageURL'] = $imageURL;
                }
                $dataAlbum['imageURL']= $imageURL;
                $maAlbum = $this-> uri-> rsegment(3);
                
                $this-> Album_model->update($maAlbum,$dataAlbum);
                redirect(admin_url('Album/add_baihat/').$maAlbum);
    } 

    /*
     * chỉnh sửa nghệ sĩ
     */
    function load_edit()
    {
        //Lấy mã album
        $maAlbum =$this -> uri -> rsegment('3');   
        $album = $this -> Album_model -> get_info($maAlbum);
        if(!$album)
        {
            $this-> session -> set_flashdata('message','Không tồn tại album này.'); 
            redirect(admin_url('NgheSi'));                   
        }   
        $this -> data['album']  = $album;  

         //Lấy danh sách quốc gia
        $this-> load-> model('QuocGia_model');
        $quocgia = $this->QuocGia_model->get_list();
        $this->data['quocgia'] = $quocgia;


        //lấy danh sách chủ đề thuộc album
        $this-> db->select('*');
        $this-> db-> from('album_chude');
        $this-> db-> join('chude','album_chude.machude=chude.machude');
        $this-> db-> where('maAlbum',$maAlbum);
        $query= $this-> db-> get();
        $listCD_AB= $query->result_array();
        $this-> data['listCD'] = $listCD_AB;

        //lấy danh sách chủ đề
        $listCD = $this-> ChuDe_model->get_list();
        $this->data['chude']=$listCD;        
        
        //load view
        $this->data['temp'] = 'admin/album/edit';
        $this->load->view('admin/main-layout', $this->data);       
    }

    function edit()
    {

        if(!empty($_POST['tenAlbum']) && !empty($_POST['maQuocGia']) && !empty($_POST['list_chude']))
            {
                $dataPost= $_POST;
                $tenAlbum = $dataPost['tenAlbum'];
                $maQuocGia = $dataPost['maQuocGia'];
                $maAlbum = $dataPost['maAlbum'];
                $this -> load -> library('upload_library');

                $data = array(
                    'maAlbum' => $maAlbum,
                    'tenAlbum' => $tenAlbum,
                    'maQuocGia' =>$maQuocGia
                );

                //Cập nhật vào csdl
                if($this -> Album_model -> update($maAlbum,$data)){
                    //tạo nội dung thông báo
                    $this-> session -> set_flashdata('message','Cập nhật album thành công.');

                }
                else{
                    $this-> session -> set_flashdata('message','Cập nhật album không thành công.');
                }
                //lấy danh sách chủ đề thuộc album
                 $this-> db->select('chude.*');
                 $this-> db-> from('album_chude');
                  $this-> db-> join('chude','album_chude.machude=chude.machude');
                 $this-> db-> where('maAlbum',$maAlbum);
                 $query= $this-> db-> get();
                 $chude= $query->result_array();
                 // delete danh sách chủ đề cũ
                 foreach ($chude as $key => $value) {
                $this -> Album_ChuDe_model -> delete($maAlbum,$value["maChuDe"]);
                }
                // thêm danh sách chủ đề mới
                 foreach ($dataPost['list_chude'] as $key => $value) {
                    $data= array('maAlbum'=> $maAlbum,'maChuDe'=>$value['machude']);
                    $this -> Album_ChuDe_model -> create($data);
                }

                echo $maAlbum;
            }
        
    }
    function edit_image()
    {
        $maAlbum = $this-> uri-> rsegment(3);
        $album= $this-> Album_model->get_info($maAlbum);
        $this-> data['album']= $album;
        $this->data['temp'] = 'admin/album/edit_image';
        $this->load->view('admin/main-layout', $this->data);
    } 
      function edit_image_perform()
    {

                $maAlbum = $this-> uri-> rsegment(3);
                $album= $this-> Album_model->get_info($maAlbum);
                $this -> load -> library('upload_library');
                $upload_path = './upload/img';
                $upload_data =$this -> upload_library -> upload($upload_path, 'image');
                $imageURL = '';
                if(isset($upload_data['file_name']))
                {
                    $imageURL= $upload_data['file_name'];
                    $data['imageURL'] = $imageURL;
                    // lấy link hình cũ
                    $imageURL_old='./upload/img/'.$album->imageURL;
                }
                if(file_exists($imageURL_old)) 
                    {
                        unlink($imageURL_old);
                    }

                $dataAlbum['imageURL']= $imageURL;
                $this-> Album_model->update($maAlbum,$dataAlbum);
                redirect(admin_url('Album/add_baihat/').$maAlbum);
    } 


    /*
     * Xóa album
     */
    function del()
    {
        $maAlbum = $this -> uri -> rsegment(3);
        $this->_del($maAlbum);
        $this-> session -> set_flashdata('message','Xóa album thành công'); 
        redirect(admin_url('album'));        
    }

    /*
     * Xóa tất cả album
     */  
    
    function del_all()
    {
        $ids = $this ->input-> post('ids');
        foreach($ids as $maAlbum)
        {
            $this -> _del($maAlbum);
        }

    } 
    /*
     *Xóa album
     */
    private function _del($maAlbum)
    {
        $album = $this -> Album_model-> get_info($maAlbum);
        if(!$maAlbum)
        {
            $this-> session -> set_flashdata('message','Không tồn tại nghệ sĩ này.'); 
            redirect(admin_url('album'));                   
        } 
        //thực hiện xóa
        $this -> Album_model -> delete($maAlbum);
        //Xóa ảnh nghệ sĩ
        $imageURL='./upload/img/'.$album->imageURL;
        if(file_exists($imageURL)) 
        {
            unlink($imageURL);
        }

    }



}

?>