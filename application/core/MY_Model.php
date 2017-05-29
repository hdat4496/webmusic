<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Model extends CI_Model {
	
	// Tên bảng
	var $table = '';
	
	// Key chính của bảng
	var $key = '';

	// Key chính thứ 2 của bảng (Giành cho bảng có 2 khóa chính)
	var $key_2 = '';

	// Order mặc định (VD: $order = array('id', 'desc))
	var $order = '';
	
	// Cac field select mặc định khi get_list (VD: $select = 'id, name')
	var $select = '';
	
	/**
	 * Thêm row mới
	 * $data : dữ liệu cần thêm
	 */
	function create($data = array())
	{
		if($this->db->insert($this->table, $data))
		{
		   return TRUE;
		}else{
			return FALSE;
		}
	}
	
	/**
	 * Cập nhật row từ id
	 * $id : khóa chỉnh của bảng cần sửa
	 * $data : mảng dữ liệu cần sửa
	 */
	function update($id, $data)
	{
		if (!$id)
		{
			return FALSE;
		}
		
		$where = array();
	 	$where[$this->key] = $id;
	    $this->update_rule($where, $data);
	 	
	 	return TRUE;
	}
	
	/**
	 * Cập nhật row từ bảng có nhiều id
	 * $id : khóa chính của bảng cần sửa
	 * $id_2 : khóa chính thứ 2 của bảng cần sửa
	 * $data : mang du lieu can sua
	 */
	function update_mutikey($id,$id_2, $data)
	{
		if (!($id && $id_2))
		{
			return FALSE;
		}
		
		$where = array();
	 	$where[$this->key] = $id;
	 	$where[$this->key_2] = $id_2;	 	
	    $this->update_rule($where, $data);
	 	
	 	return TRUE;
	}


	/**
	 * Cập nhật row từ điều kiện
	 * $where : điều kiện
	 * $data : mảng dữ liệu cần cập nhật
	 */
	function update_rule($where, $data)
	{
		if (!$where)
		{
			return FALSE;
		}
		
	 	$this-> db->where($where);
	 	$this-> db->update($this->table, $data);

	 	return TRUE;
	}

	/**
	 * Xóa row từ id
	 * $id : giá trị của khóa chính
	 */
	function delete($id)
	{
		if (!$id)
		{
			return FALSE;
		}

		if($id)
		{
			$where = array($this->key => $id);
		}else
		{
		 	$this->db->where($where);
		}
	 	$this->del_rule($where);
		
		return TRUE;
	}

	/**
	 * Xóa row từ bảng có 2 khóa chính
	 * $id : giá trị của khóa chính thứ nhất
	 * $id_2 : giá trị của khóa chính thứ 2
	 */
	function delete_mutikey($id,$id_2)
	{
		if (!($id && $id_2))
		{
			return FALSE;
		}

		if($id && $id_2)
		{
			$where = array($this->key => $id,$this ->key_2 => $id_2);
		}else
		{
		 	$this->db->where($where);
		}
	 	$this->del_rule($where);
		
		return TRUE;
	}


	
	/**
	 * Xóa row từ điều kiện
	 * $where : mảng điều kiện để xóa
	 */
	function del_rule($where)
	{
		if (!$where)
		{
			return FALSE;
		}
		
	 	$this->db->where($where);
		$this->db->delete($this->table);
	 
		return TRUE;
	}
	
	/**
	 * Thực hiện câu lệnh query
	 * $sql : câu lệnh sql
	 */
	function query($sql){
		$rows = $this->db->query($sql);
		return $rows->result;
	}
	
	/**
	 * Lấy thông tin của row từ id
	 * $id : id cần lấy thông tin
	 * $field : Cột dữ liệu cần lấy
	 */
	function get_info($id, $field = '')
	{
		if (!$id)
		{
			return FALSE;
		}
	 	
	 	$where = array();
	 	$where[$this->key] = $id;
	 	
	 	return $this->get_info_rule($where, $field);
	}

	/**
	 * Lấy thông tin của row từ id
	 * $id,$id_2 : id,id_@ cần lấy thông tin
	 * $field : cột dữ liệu cần lấy
	 */
	function get_info_mutikey($id,$id_2, $field = '')
	{
		if (!($id && $id_2))
		{
			return FALSE;
		}
	 	
	 	$where = array();
	 	$where[$this->key] = $id;
	 	$where[$this->key_2] = $id_2;
	 	
	 	return $this->get_info_rule($where, $field);
	}	
	
	/**
	 * Lấy thông tin của row từ điều kiện
	 * $where: Mảng điều kiện
	 * $field: Cột muốn lấy dữ liệu
	 */
	function get_info_rule($where = array(), $field= '')
	{
	    if($field)
	    {
	        $this->db->select($field);
	    }
		$this->db->where($where);
		$query = $this->db->get($this->table);
		if ($query->num_rows())
		{
			return $query->row();
		}
		
		return FALSE;
	}
	
	/**
	 * Lấy tổng số
	 */
	function get_total($input = array())
	{
		$this->get_list_set_input($input);
		
		$query = $this->db->get($this->table);
		
		return $query->num_rows();
	}
	
	/**
	 * Lấy tổng số
	 * $field: cột muốn tính tổng số
	 */
	function get_sum($field, $where = array())
	{
		$this->db->select_sum($field);//tinh rong
		$this->db->where($where);//dieu kien
		$this->db->from($this->table);
		
		$row = $this->db->get()->row();
		foreach ($row as $f => $v)
		{
			$sum = $v;
		}
		return $sum;
	}
	
	/**
	 * Lấy 1 row
	 */
	function get_row($input = array()){
		$this->get_list_set_input($input);
		
		$query = $this->db->get($this->table);
		
		return $query->row();
	}
	
	/**
	 * Lấy danh sách
	 * $input : mảng các dữ liệu đầu vào
	 */
	function get_list($input = array())
	{
	    //Xử lý các dữ liệu đầu vào
		$this->get_list_set_input($input);
		
		//Thực hiện truy vấn dữ liệu
		$query = $this->db->get($this->table);
		//echo $this->db->last_query();
		return $query->result();
	}
	
	/**
	 * Gắn các thuộc tính trong input khi lấy danh sách
	 * $input : mảng dữ liệu đầu vào
	 */
	
	protected function get_list_set_input($input = array())
	{
		
		// Thêm điều kiện cho câu truy vấn truyền qua biến $input['where'] 
		//(vi du: $input['where'] = array('email' => 'abc@gmail.com'))
		if ((isset($input['where'])) && $input['where'])
		{
			$this->db->where($input['where']);
		}
		
		//Tìm kiếm like
		// $input['like'] = array('name' => 'abc');
	    if ((isset($input['like'])) && $input['like'])
		{
			$this->db->like($input['like'][0], $input['like'][1]); 
		}
		
		// Thêm sắp xếp dữ liệu thông qua biến $input['order'] 
		//(ví dụ $input['order'] = array('id','DESC'))
		if (isset($input['order'][0]) && isset($input['order'][1]))
		{
			$this->db->order_by($input['order'][0], $input['order'][1]);
		}
		else
		{
			//mặc định sẽ sắp xếp theo id giảm dần 
			$order = ($this->order == '') ? array($this->table.'.'.$this->key, 'desc') : $this->order;
			$this->db->order_by($order[0], $order[1]);
		}
		
		// Thêm điều kiện limit cho câu truy vấn thông qua biến $input['limit'] 
		//(ví dụ $input['limit'] = array('10' ,'0')) 
		if (isset($input['limit'][0]) && isset($input['limit'][1]))
		{
			$this->db->limit($input['limit'][0], $input['limit'][1]);
		}
		
	}
	
	/**
	 * kiểm tra sự tồn tại của dữ liệu theo 1 điều kiện nào đó
	 * $where : mảng dữ liệu điều kiện
	 */
    function check_exists($where = array())
    {
	    $this->db->where($where);
	    //thực hiện câu truy vấn lấy dữ liệu
		$query = $this->db->get($this->table);
		
		if($query->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
}
?>