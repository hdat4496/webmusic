<?php 
/**
* 
*/
class NgheSi_model extends MY_Model
{
	var $table = 'nghesi';
	var $key = 'maNgheSi';

	public function layDSBaiHayCuaNgheSi($maNgheSi)
	{
		$this->db->select('BAIHAT.*');
        $this->db->from('BAIHAT');
        $this->db->join('TRINHBAY', 'BAIHAT.maBaiHat = TRINHBAY.maBaiHat');
        $this->db->where('TRINHBAY.maCaSi', $maNgheSi);
		return $this -> db ->get()->result_array();	
	}
}

 ?>