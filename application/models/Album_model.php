<?php 
/**
* 
*/
class Album_model extends MY_Model
{
	var $table = 'album';
	var $key = 'maAlbum';
	
	public function layDSAlbumChuDe($maChuDe)
	{
		$this->db->select('album.*');
        $this->db->from('album');
        $this->db->join('album_chude', 'album.maAlbum = album_chude.maAlbum');
        $this->db->where('album_chude.maChuDe', $maChuDe);
		return $this -> db ->get()->result_array();	
	}	

	public function layDSNgheSiAlbum($maAlbum)
	{
		$this->db->select('trinhbay.maCaSi');
        $this->db->from('album_baihat');
        $this->db->join('trinhbay', 'album_baihat.maBaiHat = trinhbay.maBaiHat');
        $this->db->where('album_baihat.maAlbum', $maAlbum);
        $this->db->limit(1,0);
		return $this -> db ->get()->result_array();	
	}

	public function layDSGoiYAlbumCuaNgheSi($maNgheSi,$maAlbum)
	{
		$this->db->distinct();
		$this->db->select('album.*');
        $this->db->from('album_baihat');
        $this->db->join('trinhbay', 'album_baihat.maBaiHat = trinhbay.maBaiHat');
        $this->db->join('album', 'album_baihat.maAlbum = album.maAlbum');
        $this->db->where('trinhbay.maCaSi', $maNgheSi);
        $this->db->where_not_in('album.maAlbum', $maAlbum);
		$this->db->order_by("luotNghe", "desc");      
        $this->db->limit(10,0);
		return $this -> db ->get()->result_array();	
	}
}


 ?>