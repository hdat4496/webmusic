<!--head-->
<?php $this -> load -> view('admin/playlist/head', $this-> data) ?>

<div class="line"></div>

<div class="wrapper" id="main_product">
	<br>
	<?php $this -> load -> view('admin/message',$this-> data);?>
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck"></span>
			<h6>Danh sách playlist</h6>
		 	<div class="num f12">Số lượng: <b id="total"><?php echo $total_rows ?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
			
			<thead class="filter"><tr><td colspan="8">
				<form class="list_filter form" action="<?php echo admin_url('playlist') ?>" method="get">
					<table cellpadding="0" cellspacing="0" width="80%"><tbody>
					
						<tr>
							<td class="label" style="width:55px;"><label for="filter_maAlbum">Mã playlist</label></td>
							<td class="item"><input name="maPlayList" value="<?php echo $this -> input ->get('maPlayList') ?>" id="filter_maPlayList" type="text" style="width:100px;"></td>
							
							<td class="label" style="width:65px;"><label for="filter_id">Tên playlist</label></td>
							<td class="item" style="width:155px;"><input name="tenPlayList" value="<?php echo $this -> input ->get('tenPlayList') ?>" id="filter_tenPlayList" type="text" style="width:155px;"></td>
							
							<td class="label" style="width:60px;"><label for="filter_TaiKhoan">Tài khoản</label></td>
							<td class="item" style="width:155px;"><input name="taikhoan" value="<?php echo $this -> input ->get('taikhoan') ?>" id="filter_taikhoant" type="text" style="width:155px;"></td>
							
							<td style="width:150px">
							<input type="submit" class="button blueB" value="Lọc">
							<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('playlist') ?>'; ">
							</td>
							
						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin/images')?>/icons/tableArrows.png"></td>
					<td style="width:60px;">Mã playlist</td>
					<td style="width:300px;">Tên playlist</td>
					<td>Mã tài khoản</td>
					<td>Ngày tạo</td>											
					<td style="width:120px;">Hành động</td>
				</tr>
			</thead>
			
 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="8">
						 <div class="list_action itemActions">
								<a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('playlist/del_all') ?>">
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
			<?php foreach ($list as $row): ?>
			    <tr class="row_<?php echo $row->maPlayList?>"> 
					<td><input type="checkbox" name="id[]" value="<?php echo $row->maPlayList ?>"></td>
					<td class="textC"><?php echo $row->maPlayList ?></td>
					<td>
						<a href="" class="tipS" title="" target="_blank">
							<b><?php echo $row->tenPlayList ?></b>
						</a>
					</td>
					<td class="textC"> <?php echo $row->taikhoan ?>
					</td>		
					<td class="textC"> <?php echo date("d/m/Y",strtotime($row->ngaytao)) ?> </td>

					<td class="option textC">
						<a href="<?php echo admin_url('album/view/').$row->maPlayList?>" title="Chi tiết" class="tipS">
							<img src="<?php echo public_url('admin/images')?>/icons/color/view.png">
						</a>
						
						<a href="<?php echo admin_url('album/del/').$row->maPlayList ?>" class="tipS verify_action">
						    <img src="<?php echo public_url('admin/images')?>/icons/color/delete.png">
						</a>
					</td>
				</tr> 
				<?php endforeach; ?>       
		    </tbody>		
		</table>
	</div>	
</div>













