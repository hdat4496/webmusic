<!--head-->
<?php $this -> load -> view('admin/taikhoan/head', $this-> data) ?>

<div class="line"></div>

<div class="wrapper">
	<br>
	<?php $this -> load -> view('admin/message',$this-> data);?>
	<div class="widget">
	
		<div class="title">

			<h6>Danh sách quản trị viên</h6>
		 	<div class="num f12">Tổng số: <b>		<?php echo $total; ?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
			<thead>
				<tr>

					<td style="width:80px;">Tên tài khoản</td>
					<td>Họ và tên</td>
					<td>Giới tính</td>
					<td>Email</td>
					<td style="width:100px;">Hành động</td>
				</tr>
			</thead>
			

 			
			<tbody>
			<?php foreach ($list as $row):?>
				<tr>

					<td class="textC"><?php echo $row -> taiKhoan ?></td>
					<td><span title="<?php echo $row -> hoTen ?>" class="tipS"><?php echo $row -> hoTen ?></span></td>
					<td><span title="<?php echo $row -> gioiTinh ?>" class="tipS"><?php echo $row -> gioiTinh ?></span></td>
					<td><span title="<?php echo $row -> email ?>" class="tipS"><?php echo $row -> email ?></span></td>
						
						
					<td class="option">
						<a href="<?php echo admin_url('TaiKhoan/edit/').$row->taiKhoan?>" title="Chỉnh sửa" class="tipS ">
							<img src="<?php echo public_url('admin')?>/images/icons/color/edit.png" />
						</a>
							
						<a href="<?php echo admin_url('TaiKhoan/delete/').$row->taiKhoan?>"  title="Xóa" class="tipS verify_action">
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