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
		$this->db->select('NGHESI.*');
        $this->db->from('BAIHAT');
        $this->db->join('TRINHBAY', 'BAIHAT.maBaiHat = TRINHBAY.maBaiHat');
        $this->db->join('NGHESI', 'NGHESI.maNgheSi = TRINHBAY.maCaSi');
        $this->db->where('BAIHAT.maBaiHat', $maBaiHat);
		return $this -> db ->get()->result_array();	
	}

	public function layDSNhacSiBaiHat($maBaiHat)
	{
		$this->db->select('NGHESI.*');
        $this->db->from('BAIHAT');
        $this->db->join('SANGTAC', 'BAIHAT.maBaiHat = SANGTAC.maBaiHat');
        $this->db->join('NGHESI', 'NGHESI.maNgheSi = SANGTAC.maNhacSi');
        $this->db->where('BAIHAT.maBaiHat', $maBaiHat);
		return $this -> db ->get()->result_array();	
	}

	public function layDSChuDeBaiHat($maBaiHat)
	{
		$this->db->select('CHUDE.*');
        $this->db->from('BAIHAT_CHUDE');
        $this->db->join('CHUDE', 'BAIHAT_CHUDE.maChuDe = CHUDE.maChuDe');
        $this->db->where('BAIHAT_CHUDE.maBaiHat', $maBaiHat);
		return $this -> db ->get()->result_array();	
	}

	public function layDSBaiHatYeuThich($taiKhoan)
	{
		$this->db->select('BAIHAT.*');
        $this->db->from('BAIHAT');
        $this->db->join('BAIHAT_YEUTHICH', 'BAIHAT.maBaiHat = BAIHAT_YEUTHICH.maBaiHat');
        $this->db->where('BAIHAT_YEUTHICH.taiKhoan', $taiKhoan);
		return $this -> db ->get()->result_array();	
	}
}

 ?>