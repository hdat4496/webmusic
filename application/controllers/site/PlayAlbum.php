<?php 

class PlayAlbum extends MY_Controller
{
	

	function __construct()
	{
		parent::__construct();
		$this -> load -> model('Album_model');
		$this -> load -> model('LuotNghe_model');
        $this -> load -> model('BaiHatYeuThich_model'); 


	}

	function play()
	{
		$maAlbum = $this -> uri-> rsegment(3);
		$album = $this -> Album_model -> get_info($maAlbum);

		$query=$this-> db->query("call sp_Get_BaiHat_maAlbum('$maAlbum')");
		mysqli_next_result($this->db->conn_id);


		$data['dsBaiHat']= $query->result();
		$data_dsbaihat = (array)$data['dsBaiHat'];
		foreach ($data_dsbaihat as $key => $value) {
			$value->title = $value->tenBaiHat;
			$query=$this-> db->query("call sp_Get_BaiHat_in_Album_maBH('$value->maBaiHat')");
			mysqli_next_result($this->db->conn_id);
			$baiHat = $query->result();
			$value->artist = $baiHat[0]->ngheSi;
			$value->cover = base_url('upload/img/').$baiHat[0]->imageURL;
			$value->mp3 =  base_url('upload/music/').$baiHat[0]->url;
			unset($value->maBaiHat);
			unset($value->tenBaiHat);
			unset($value->imageURL);
			unset($value->url);
			unset($value->loiBaiHat);
			unset($value->ngayPhatHanh);
			unset($value->maQuocGia);	
			unset($value->luotNghe);
			unset($value->luotThich);
			unset($value->luotTai);
			$value->album = '';
		}

		$data['json']=json_encode($data_dsbaihat);
		$data['album']= $album;
		$dataAlbum = array(
			'luotNghe' => $album->luotNghe + 1
		);

		$this -> Album_model ->update($maAlbum,$dataAlbum);

		$data['temp']= 'site/playalbum/index';
		$data['title'] = 'Album';	
		$this -> load -> view('site/layout',$data);
	}
}
 ?>