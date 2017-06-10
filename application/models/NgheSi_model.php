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
		$this->db->select('baihat.*');
        $this->db->from('baihat');
        $this->db->join('trinhbay', 'baihat.maBaiHat = trinhbay.maBaiHat');
        $this->db->where('trinhbay.maCaSi', $maNgheSi);
		return $this -> db ->get()->result_array();	
	}
}

 ?>