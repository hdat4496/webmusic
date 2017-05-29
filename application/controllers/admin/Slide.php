<?php
Class Slide extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        //load ra file model
        $this->load->model('Slide_model');
    }
    
    /*
     * Hien thi danh sach Slide
     */
    function index()
    {
        //lay tong so luong ta ca cac Slide trong website
        $total_rows = $this->Slide_model->get_total();
        $this->data['total_rows'] = $total_rows;

        $input = array();
       
        //lay danh sach Slide
        $list = $this->Slide_model->get_list($input);
        $this->data['list'] = $list;
       
        //lay nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        
        //load view
        $this->data['temp'] = 'admin/Slide/index';
        $this->load->view('admin/main-layout', $this->data);
    }
    
    /*
     * Them Slide moi
     */
    function add()
    {
        
        //load thư viện validate dữ liệu
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('tenSlide', 'Tên Slide', 'required');
            
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
               
                //lay ten file anh minh hoa duoc update len
                $this->load->library('upload_library');
                $upload_path = './upload/Slide';
                $upload_data = $this->upload_library->upload($upload_path, 'image');  
                $imageURL = '';
                if(isset($upload_data['file_name']))
                {
                    $imageURL = $upload_data['file_name'];
                }
               
                //luu du lieu can them
                $data = array(
                    'maSlide' =>'sl001',
                    'tenSlide'       => $this->input->post('tenSlide'),
                    'imageURL' => $imageURL,
                    'url'       => $this->input->post('url'),
                    'info'       => $this->input->post('info'),
                    'thuTuHienThi' => $this->input->post('thuTuHienThi'),
                ); 
                //them moi vao csdl
                if($this->Slide_model->create($data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không thêm được');
                }
                //chuyen tới trang danh sách
                redirect(admin_url('Slide'));
            }
        }
        
        
        //load view
        $this->data['temp'] = 'admin/Slide/add';
        $this->load->view('admin/main-layout', $this->data);
    }
    
    /*
     * Chinh sua Slide
     */
    function edit()
    {
        $maSlide = $this->uri->rsegment('3');
        $Slide = $this->Slide_model->get_info($maSlide);
        if(!$Slide)
        {
            //tạo ra nội dung thông báo
            $this->session->set_flashdata('message', 'Không tồn tại Slide này');
            redirect(admin_url('Slide'));
        }
        $this->data['Slide'] = $Slide;
       
       
        //load thư viện validate dữ liệu
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this-> form_validation->set_rules('tenSlide', 'Tên Slide', 'required');
            
            //nhập liệu chính xác
            if($this-> form_validation->run())
            {
               
                //lay ten file anh minh hoa duoc update len
                $this->load->library('upload_library');
                $upload_path = './upload/slide';
                $upload_data = $this->upload_library->upload($upload_path, 'image');
                $imageURL = '';
                if(isset($upload_data['file_name']))
                {
                    $imageURL = $upload_data['file_name'];
                }
            
                //luu du lieu can them
                $data = array(
                    'tenSlide'       => $this-> input->post('tenSlide'),
                    'url'       => $this-> input->post('url'),
                    'info'       => $this-> input->post('info'),
                    'thuTuHienThi' => $this-> input->post('thuTuHienThi'),
                ); 
                if($imageURL != '')
                {
                    $data['imageURL'] = $imageURL;
                }
               
                //them moi vao csdl
                if($this->Slide_model->update($Slide->maSlide, $data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không cập nhật được');
                }
                //chuyen tới trang danh sách
                redirect(admin_url('Slide'));
            }
        }
        
        
        //load view
        $this->data['temp'] = 'admin/Slide/edit';
        $this->load->view('admin/main-layout', $this->data);
    }
    
    /*
     * Xoa du lieu
     */
    function delete()
    {
        $id = $this->uri->rsegment(3);
        $this->_del($id);
        
        //tạo ra nội dung thông báo
        $this->session->set_flashdata('message', 'Xóa Slide thành công');
        redirect(admin_url('Slide'));
    }
    
    /*
     * Xóa nhiều Slide
     */
    function del_all()
    {
        //lay tat ca id Slide muon xoa
        $ids = $this->input->post('ids');
        foreach ($ids as $maSlide)
        {
            $this->_del($maSlide);
        }
    }
    
    /*
     *Xoa Slide
     */
    private function _del($maSlide)
    {
        $Slide = $this-> Slide_model->get_info($maSlide);
        if(!$Slide)
        {
            //tạo ra nội dung thông báo
            $this-> session->set_flashdata('message', 'không tồn tại Slide này');
            redirect(admin_url('Slide'));
        }
        //thuc hien xoa Slide
        $this->Slide_model->delete($maSlide);
        //xoa cac anh cua Slide
        $imageURL = './upload/Slide/'.$Slide->imageURL;
        if(file_exists($imageURL))
        {
            unlink($imageURL);
        }
        
    }

}



