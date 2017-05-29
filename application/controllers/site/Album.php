<?php 

class Album extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this -> load -> model('ChuDe_model');
		$this -> load -> model('Album_model');
	}	


	function index()
	{

		$list_chude = $this -> ChuDe_model -> get_list();
		$this -> data['list_chude'] = $list_chude;

		$data['temp']= 'site/album/index';
		$data['title'] = 'Album';		
		$this -> load -> view('site/layout',$data);

	}
}
 ?>