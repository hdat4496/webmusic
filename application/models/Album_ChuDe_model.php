<?php 
/**
* 
*/
class Album_ChuDe_model extends MY_Model
{
	var $table = 'album_chude';
	var $key = 'maAlbum';
	var $key_2 = 'maChuDe';
	public function layDSChuDeAlbum($maAlbum)
	{
		$this-> db->select('chude.*');
        $this-> db-> from('album_chude');
        $this-> db-> join('chude','album_chude.machude=chude.machude');
        $this-> db-> where('maAlbum',$maAlbum);
        return $this-> db-> get()->result_array();
	}
	
}


 ?>