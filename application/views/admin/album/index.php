<!--head-->
<?php $this -> load -> view('admin/album/head', $this-> data) ?>

<div class="line"></div>

<div class="wrapper" id="main_product">
	<br>
	<?php $this -> load -> view('admin/message',$this-> data);?>
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck"></span>
			<h6>Danh sách album</h6>
		 	<div class="num f12">Số lượng: <b><?php echo $total_rows ?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
			
			<thead class="filter"><tr><td colspan="8">
				<form class="list_filter form" action="<?php echo admin_url('album') ?>" method="get">
					<table cellpadding="0" cellspacing="0" width="80%"><tbody>
					
						<tr>
							<td class="label" style="width:55px;"><label for="filter_maAlbum">Mã album</label></td>
							<td class="item"><input name="maAlbum" value="<?php echo $this -> input ->get('maAlbum') ?>" id="filter_maAlbum" type="text" style="width:100px;"></td>
							
							<td class="label" style="width:65px;"><label for="filter_id">Tên album</label></td>
							<td class="item" style="width:155px;"><input name="tenAlbum" value="<?php echo $this -> input ->get('tenAlbum') ?>" id="filter_tenAlbum" type="text" style="width:155px;"></td>
							
							<td class="label" style="width:60px;"><label for="filter_QuocGia">Quốc gia</label></td>
							<td class="item">
								<select name="quocgia">
									<option value=""></option>	
									<?php foreach ($quocgia as $row): ?>	
										<option value="<?php echo $row->maQuocGia?>" <?php echo ($this->input->get('quocgia') == $row->maQuocGia ) ? 'selected' : ''?> ><?php echo $row->tenQuocGia ?></option>}
									<?php endforeach; ?>															    
								</select>
							</td>
							
							<td style="width:150px">
							<input type="submit" class="button blueB" value="Lọc">
							<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('album') ?>'; ">
							</td>
							
						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin/images')?>/icons/tableArrows.png"></td>
					<td style="width:150px;">Mã album</td>
					<td style="width:300px;">Tên album</td>
					<td>Quốc gia</td>
					<td>Trình bày</td>
					<td>Ngày tạo</td>											
					<td style="width:120px;">Hành động</td>
				</tr>
			</thead>
			
 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="8">
						 <div class="list_action itemActions">
								<a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('album/del_all') ?>">
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
			    <tr class="row_<?php echo $row->maAlbum?>"> 
					<td><input type="checkbox" name="id[]" value="<?php echo $row->maAlbum ?>"></td>
					<td class="textC"><?php echo $row->maAlbum ?></td>
					<td>
						<div class="image_thumb">
							<img src="<?php echo base_url('upload/img/'.$row->imageURL)?>" height="50">
							<div class="clear"></div>
						</div>
						<a href="" class="tipS" title="" target="_blank">
							<b><?php echo $row->tenAlbum ?></b>
						</a>
						<div class="f11">Lượt nghe: <?php echo $row->luotNghe ?>				</div>
					</td>
					<td class="textC"> 
						<?php foreach($quocgia as $i):
							if($i->maQuocGia == $row->maQuocGia) echo $i->tenQuocGia;
						endforeach; ?> 
					</td>				
					<td class="textC"> 
						<?php foreach($nghesi as $i):
							if($i->maAlbum == $row->maAlbum) echo $i->ngheSi;
						endforeach; ?> 
					</td>
					<td class="textC"> <?php echo $row->ngayTao ?> </td>


					<td class="option textC">
						<a href="<?php echo admin_url('album/view/').$row->maAlbum?>" title="Chi tiết" class="tipS">
							<img src="<?php echo public_url('admin/images')?>/icons/color/view.png">
						</a>
						<a href="<?php echo admin_url('album/edit/').$row->maAlbum?>" title="Chỉnh sửa" class="tipS">
							<img src="<?php echo public_url('admin/images')?>/icons/color/edit.png">
						</a>
						
						<a href="<?php echo admin_url('album/del/').$row->maAlbum ?>" class="tipS verify_action">
						    <img src="<?php echo public_url('admin/images')?>/icons/color/delete.png">
						</a>
					</td>
				</tr> 
				<?php endforeach; ?>       
		    </tbody>		
		</table>
	</div>	
</div>













