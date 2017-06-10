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
		$this->db->select('nghesi.*');
        $this->db->from('baihat');
        $this->db->join('trinhbay', 'baihat.maBaiHat = trinhbay.maBaiHat');
        $this->db->join('nghesi', 'nghesi.maNgheSi = trinhbay.maCaSi');
        $this->db->where('baihat.maBaiHat', $maBaiHat);
		return $this -> db ->get()->result_array();	
	}

	public function layDSNhacSiBaiHat($maBaiHat)
	{
		$this->db->select('nghesi.*');
        $this->db->from('baihat');
        $this->db->join('sangtac', 'baihat.maBaiHat = sangtac.maBaiHat');
        $this->db->join('nghesi', 'nghesi.maNgheSi = sangtac.maNhacSi');
        $this->db->where('baihat.maBaiHat', $maBaiHat);
		return $this -> db ->get()->result_array();	
	}

	public function layDSChuDeBaiHat($maBaiHat)
	{
		$this->db->select('chude.*');
        $this->db->from('baihat_chude');
        $this->db->join('chude', 'baihat_chude.maChuDe = chude.maChuDe');
        $this->db->where('baihat_chude.maBaiHat', $maBaiHat);
		return $this -> db ->get()->result_array();	
	}

	public function layDSBaiHatYeuThich($taiKhoan)
	{
		$this->db->select('baihat.*');
        $this->db->from('baihat');
        $this->db->join('baihat_yeuthich', 'baihat.maBaiHat = baihat_yeuthich.maBaiHat');
        $this->db->where('baihat_yeuthich.taiKhoan', $taiKhoan);
		return $this -> db ->get()->result_array();	
	}

	public function layDSGoiYBaiHatCuaNgheSi($maNgheSi,$maBaiHat)
	{
		$this->db->distinct();
		$this->db->select('baihat.*');
        $this->db->from('baihat');
        $this->db->join('trinhbay', 'baihat.maBaiHat = trinhbay.maBaiHat');
        $this->db->where('trinhbay.maCaSi', $maNgheSi);
        $this->db->where_not_in('baihat.maBaiHat', $maBaiHat);
		$this->db->order_by("luotNghe", "desc"); 
        $this->db->limit(10,0);
		return $this -> db ->get()->result_array();	
	}

	public function layDSNgheSi($maBaiHat)
	{
		$this->db->select('trinhbay.maCaSi');
        $this->db->from('baihat');
        $this->db->join('trinhbay', 'baihat.maBaiHat = trinhbay.maBaiHat');
        $this->db->where('trinhbay.maBaiHat', $maBaiHat);
        $this->db->limit(1,0);
		return $this -> db ->get()->result_array();	
	}

	


	public function kiemTraLuotNgheTrongNgay($maBaiHat)
	{
		$this->db->select('luotNghe.*');
        $this->db->from('luotNghe');
        $this->db->where('luotNghe.maBaiHat', $maBaiHat);
        $this->db->where('luotNghe.ngay', date('Y-m-d'));
		return $this -> db ->get()->result_array();	
	}
	
}

 ?>