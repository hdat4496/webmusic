<!--head-->
<?php $this -> load -> view('admin/chude/head', $this-> data) ?>

<div class="line"></div>

<div class="wrapper">
	<br>
	<?php $this -> load -> view('admin/message',$this-> data);?>
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon">
				<div class="checker" id="uniform-titleCheck">
					<span>
						<input type="checkbox" id="titleCheck" name="titleCheck" style="opacity: 0;">
					</span>
				</div>
			</span>
			<h6>Danh sách chủ đề</h6>
		 	<div class="num f12">Tổng số: <b>		<?php echo $total_rows?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
			<thead>
				<tr>
					<td style="width:10px;"><img src="<?php echo public_url('admin')?>/images/icons/tableArrows.png" /></td>
					<td style="width:80px;">Mã chủ đề</td>
					<td>Tên chủ đề</td>
					<td>Mã nhóm chủ đề</td>
					<td style="width:100px;">Hành động</td>
				</tr>
			</thead>
			
 			<tfoot>
				<tr>
					<td colspan="7">
					     <div class="list_action itemActions">
								<a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('ChuDe/del_all') ?>">
									<span style='color:white;'>Xóa hết</span>
								</a>
						 </div>
							
					     <div class='pagination'>
					     	<?php echo $this -> pagination -> create_links() ?>
			             </div>
					</td>
				</tr>
			</tfoot>
 			
			<tbody>
			<?php foreach ($list as $row):?>
				<tr  class="row_<?php echo $row->maChuDe?>">
					<td><input type="checkbox" name="id[]" value="<?php echo $row -> maChuDe ?>" /></td>
					<td class="textC"><?php echo $row -> maChuDe ?></td>
					<td><span title="<?php echo $row -> tenChuDe ?>" class="tipS"><?php echo $row -> tenChuDe ?></span></td>
					<td><span title="<?php echo $row -> maNhomChuDe ?>" class="tipS"><?php echo $row -> maNhomChuDe ?></span></td>

						
					<td class="option">
						<a href="<?php echo admin_url('ChuDe/edit/').$row->maChuDe?>" title="Chỉnh sửa" class="tipS ">
							<img src="<?php echo public_url('admin')?>/images/icons/color/edit.png" />
						</a>
							
						<a href="<?php echo admin_url('ChuDe/delete/').$row->maChuDe?>"  title="Xóa" class="tipS verify_action">
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