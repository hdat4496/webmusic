<?php 

class PlaySong extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this -> load -> model('BaiHat_model');
		$this -> load -> model('LuotNghe_model');
        $this -> load -> model('BaiHatYeuThich_model');   


	}


	function Play()
	{
		$maBaiHat = $this -> uri-> rsegment(3);
		$baiHat = $this -> BaiHat_model -> get_info($maBaiHat);

		if(!$baiHat)
		{	
			$this-> session -> set_flashdata('message','Không tồn tại bài hát này.');		
			redirect(base_url('site/MY_Error'));	
		}

		//lấy danh sách nghệ sĩ bài hát
		$query=$this-> db->query("call sp_Get_NgheSi_maBH('$maBaiHat')");
		mysqli_next_result($this->db->conn_id);
 
		$databaihat = array(
			'luotNghe' => $baiHat->luotNghe + 1
		);

		$this -> BaiHat_model ->update($baiHat->maBaiHat,$databaihat);

		$KT = $this -> BaiHat_model->kiemTraLuotNgheTrongNgay($baiHat->maBaiHat);
		if(empty($KT))
		{
			$dataluotnghe= array(
				'ngay' =>date('Y-m-d'),
				'maBaiHat' => $baiHat->maBaiHat,
				'luotNghe' => 1
				);
			$this -> LuotNghe_model -> create($dataluotnghe);
		}
		else
		{
			$luotnghe= $this -> LuotNghe_model-> get_info_mutikey(date('Y-m-d'),$baiHat->maBaiHat);
			$dataluotnghe= array(
				'luotNghe' =>  $luotnghe->luotNghe+1
				);
			$this -> LuotNghe_model -> update_mutikey(date('Y-m-d'),$luotnghe->maBaiHat,$dataluotnghe);

		}

		$data['nghesi']=$query->result();
		$data['baihat'] = $baiHat;
		$data['temp']= 'site/playsong/index';
		$data['title'] = 'Song';	
		$this -> load -> view('site/layout',$data);
	}

	function CapNhatLuotTai()
	{
		$maBaiHat = $this -> uri->rsegment(3);
		$baiHat = $this -> BaiHat_model -> get_info($maBaiHat);


		$luotTai= $baiHat->luotTai+1;
		
		$dataluottai= array(
			'luotTai' =>  $luotTai
			);

		$this-> BaiHat_model -> update($maBaiHat,$dataluottai);
			
				redirect(base_url('upload/music/').$baiHat->url);
			

	}


	function CapNhatLuotThich()
	{
			$data=$_POST;

		 	$kiemtra = $this -> BaiHatYeuThich_model -> get_info_mutikey($data['taiKhoan'],$data['maBaiHat']);
 			$baiHat = $this -> BaiHat_model -> get_info($data['maBaiHat']);           	
           if(empty($kiemtra))
           {
			$dataluotthich= array(
				'taiKhoan' =>  $data['taiKhoan'],
				'maBaiHat' => 	$data['maBaiHat']
				);

           	$this ->  BaiHatYeuThich_model->create($dataluotthich);

			$dataluotthich_update= array(
				'luotThich' =>  $baiHat->luotThich+1
				);
			$this -> BaiHat_model ->update($baiHat->maBaiHat,$dataluotthich_update);


           }
           else{

           	$this ->  BaiHatYeuThich_model->delete_mutikey($data['taiKhoan'],$data['maBaiHat']);

			$dataluotthich_update= array(
				'luotThich' =>  $baiHat->luotThich-1
				);
			$this -> BaiHat_model ->update($baiHat->maBaiHat,$dataluotthich_update);

           }
			

	}

}
 ?>