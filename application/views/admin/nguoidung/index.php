<!--head-->
<?php $this -> load -> view('admin/nguoidung/head', $this-> data) ?>

<div class="line"></div>

<div class="wrapper">
	<br>
	<?php $this -> load -> view('admin/message',$this-> data);?>
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck"></span>
			<h6>Danh sách người dùng</h6>
		 	<div class="num f12">Tổng số: <b>		<?php echo $total; ?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">

			<thead class="filter"><tr><td colspan="8">
				<form class="list_filter form" action="<?php echo admin_url('NguoiDung') ?>" method="get">
					<table cellpadding="0" cellspacing="0" width="100%"><tbody>
					
						<tr>
							<td class="label" style="width:65px;"><label for="filter_taiKhoan">Tài Khoản</label></td>
							<td class="item" ><input name="taiKhoan" value="<?php echo $this -> input ->get('taiKhoan') ?>" id="filter_taiKhoan" type="text" style="width:165px;"></td>

							
							<td class="label" style="width:35px;"><label for="filter_id">Họ tên</label></td>
							<td class="item" style="width:65px;"><input name="hoTen" value="<?php echo $this -> input ->get('hoTen') ?>" id="filter_hoTen" type="text" style="width:165px;"></td>

							<td class="label" style="width:35px;"><label for="filter_id">Email</label></td>
							<td class="item" style="width:65px;"><input name="email" value="<?php echo $this -> input ->get('email') ?>" id="filter_email" type="text" style="width:145px;"></td>
														
	
							<td style="width:150px">
							<input type="submit" class="button blueB" value="Lọc">
							<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('baihat') ?>'; ">
							</td>
							
						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>

			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin/images')?>/icons/tableArrows.png"></td>
					<td style="width:150px;">Tên tài khoản</td>
					<td>Họ và tên</td>
					<td>Giới tính</td>
					<td>Email</td>
					<td style="width:100px;">Hành động</td>
				</tr>
			</thead>
			
 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="8">
						 <div class="list_action itemActions">
								<a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('NguoiDung/del_all') ?>">
									<span style="color:white;">Xóa hết</span>
								</a>
						 </div>
							
					     <div class="pagination">
							<?php echo $this -> pagination -> create_links() ?>
			             </div>
					</td>
				</tr>
			</tfoot>
 			
			<tbody class="list_item">
			<?php foreach ($list as $row):?>
				<tr>
					<td><input type="checkbox" name="id[]" value="<?php echo $row->taiKhoan ?>"></td>
					<td ><?php echo $row -> taiKhoan ?></td>
					<td><span title="<?php echo $row -> hoTen ?>" class="tipS"><?php echo $row -> hoTen ?></span></td>
					<td><span title="<?php echo $row -> gioiTinh ?>" class="tipS"><?php echo $row -> gioiTinh ?></span></td>
					<td><span title="<?php echo $row -> email ?>" class="tipS"><?php echo $row -> email ?></span></td>
						
						
					<td class="option">
						<a href="<?php echo admin_url('NguoiDung/edit/').$row->taiKhoan?>" title="Chỉnh sửa" class="tipS ">
							<img src="<?php echo public_url('admin')?>/images/icons/color/edit.png" />
						</a>
							
						<a href="<?php echo admin_url('NguoiDung/delete/').$row->taiKhoan?>"  title="Xóa" class="tipS verify_action">
							<img src="<?php echo public_url('admin')?>/images/icons/color/delete.png" />
						</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<div class="clear mt30"></div>