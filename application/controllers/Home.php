<?php 

class Home extends MY_Controller
{
	
	function index()
	{
		$this -> load -> model('Slide_model');
		$input['order'] = array('thuTuHienThi','ASC');
		$slide_list = $this-> Slide_model -> get_list($input);

		$this -> load -> model('BaiHat_model');
		$input_baihatnew['limit']= array(16,0);
		$baihat_new = $this -> BaiHat_model-> get_list($input_baihatnew); 

		$input_topnghenhieu['limit']= array(15,0);
		$input_topnghenhieu['order']= array('luotNghe','DESC');

		$message = $this -> session -> flashdata('message');
		$this -> data['message'] = $message;


		$baihat_nghenhieu = $this -> BaiHat_model-> get_list($input_topnghenhieu); 

		$data =array();
		$data['temp']= 'site/home/index';
		$data['title'] = 'Music';
		$data['slide_list']=$slide_list;
		$data['baihat_new']=$baihat_new;
		$data['baihat_nghenhieu']=$baihat_nghenhieu;
		
		$this -> load -> view('site/layout',$data);

	}
}
 ?>