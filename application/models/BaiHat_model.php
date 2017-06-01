<?php 
/**
* 
*/
class BaiHat_model extends MY_Model
{
	var $table = 'baihat';
	var $key = 'maBaiHat';

	public function layDSCaSiBaiHat($maBaiHat)
	{
		$this->db->select('NGHESI.tenNgheSi');
        $this->db->from('BAIHAT');
        $this->db->join('TRINHBAY', 'BAIHAT.maBaiHat = TRINHBAY.maBaiHat');
        $this->db->join('NGHESI', 'NGHESI.maNgheSi = TRINHBAY.maCaSi');
        $this->db->where('BAIHAT.maBaiHat', $maBaiHat);
		return $this -> db ->get()->result_array();	
	}

	public function layDSNhacSiBaiHat($maBaiHat)
	{
		$this->db->select('NGHESI.tenNgheSi');
        $this->db->from('BAIHAT');
        $this->db->join('SANGTAC', 'BAIHAT.maBaiHat = SANGTAC.maBaiHat');
        $this->db->join('NGHESI', 'NGHESI.maNgheSi = SANGTAC.maNhacSi');
        $this->db->where('BAIHAT.maBaiHat', $maBaiHat);
		return $this -> db ->get()->result_array();	
	}
}

 ?>