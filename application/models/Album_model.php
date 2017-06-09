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
		$this->db->select('ALBUM.*');
        $this->db->from('ALBUM');
        $this->db->join('ALBUM_CHUDE', 'ALBUM.maAlbum = ALBUM_CHUDE.maAlbum');
        $this->db->where('ALBUM_CHUDE.maChuDe', $maChuDe);
		return $this -> db ->get()->result_array();	
	}	

	public function layDSNgheSiAlbum($maAlbum)
	{
		$this->db->select('TRINHBAY.maCaSi');
        $this->db->from('ALBUM_BAIHAT');
        $this->db->join('TRINHBAY', 'ALBUM_BAIHAT.maBaiHat = TRINHBAY.maBaiHat');
        $this->db->where('ALBUM_BAIHAT.maAlbum', $maAlbum);
        $this->db->limit(1,0);
		return $this -> db ->get()->result_array();	
	}

	public function layDSGoiYAlbumCuaNgheSi($maNgheSi,$maAlbum)
	{
		$this->db->distinct();
		$this->db->select('ALBUM.*');
        $this->db->from('ALBUM_BAIHAT');
        $this->db->join('TRINHBAY', 'ALBUM_BAIHAT.maBaiHat = TRINHBAY.maBaiHat');
        $this->db->join('ALBUM', 'ALBUM_BAIHAT.maAlbum = ALBUM.maAlbum');
        $this->db->where('TRINHBAY.maCaSi', $maNgheSi);
        $this->db->where_not_in('ALBUM.maAlbum', $maAlbum);
		$this->db->order_by("luotNghe", "desc");      
        $this->db->limit(10,0);
		return $this -> db ->get()->result_array();	
	}
}


 ?>