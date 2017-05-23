<!--head-->
<?php $this -> load -> view('admin/baihat/head', $this-> data) ?>

<div class="line"></div>

<div class="wrapper" id="main_product">
	<br>
	<?php $this -> load -> view('admin/message',$this-> data);?>
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck"></span>
			<h6>Danh sách bài hát</h6>
		 	<div class="num f12">Số lượng: <b><?php echo $total_rows ?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
			
			<thead class="filter"><tr><td colspan="8">
				<form class="list_filter form" action="<?php echo admin_url('BaiHat') ?>" method="get">
					<table cellpadding="0" cellspacing="0" width="80%"><tbody>
					
						<tr>
							<td class="label" style="width:55px;"><label for="filter_maBaiHat">Mã bài hát</label></td>
							<td class="item"><input name="maBaiHat" value="<?php echo $this -> input ->get('maBaiHat') ?>" id="filter_maBaiHat" type="text" style="width:55px;"></td>
							
							<td class="label" style="width:65px;"><label for="filter_id">Tên bài hát</label></td>
							<td class="item" style="width:155px;"><input name="tenBaiHat" value="<?php echo $this -> input ->get('tenBaiHat') ?>" id="filter_tenBaiHat" type="text" style="width:155px;"></td>
							
							<td class="label" style="width:60px;"><label for="filter_status">Quốc gia</label></td>
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
							<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('baihat') ?>'; ">
							</td>
							
						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('admin/images')?>/icons/tableArrows.png"></td>
					<td style="width:60px;">Mã bài hát</td>
					<td>Tên bài hát</td>
					<td>Sáng tác</td>
					<td>Trình bày</td>										
					<td style="width:80px;">Ngày phát hành</td>
					<td style="width:120px;">Hành động</td>
				</tr>
			</thead>
			
 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="8">
						 <div class="list_action itemActions">
								<a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('BaiHat/del_all') ?>">
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
			    <tr class="row_<?php echo $row->maBaiHat?>"> 
					<td><input type="checkbox" name="id[]" value="<?php echo $row->maBaiHat ?>"></td>
					<td class="textC"><?php echo $row->maBaiHat ?></td>
					<td>
						<div class="image_thumb">
							<img src="<?php echo base_url('upload/img/'.$row->imageURL)?>" height="50">
							<div class="clear"></div>
						</div>
						<a href="" class="tipS" title="" target="_blank">
							<b><?php echo $row->tenBaiHat ?></b>
						</a>
						<div class="f11">Nghe: <?php echo $row->luotNghe ?>					  | Tải: <?php echo $row->luotTai ?>				| Thích: <?php echo $row->luotThich ?>			</div>
					</td>
					<td class="textR">5,400,000 đ</td>				
					<td class="textC">01-01-1970</td>
					<td class="textC"><?php echo $row->ngayPhatHanh ?></td>



					<td class="option textC">
						<a href="" title="Gán là nhạc nổi bật" class="tipE">
							<img src="<?php echo public_url('admin/images')?>/icons/color/star.png">
						</a>
						<a href="product/view/9.html" target="_blank" class="tipS" title="Xem chi tiết sản phẩm">
							<img src="<?php echo public_url('admin/images')?>/icons/color/view.png">
						</a>
						<a href="<?php echo admin_url('BaiHat/edit/').$row->maBaiHat?>" title="Chỉnh sửa" class="tipS">
							<img src="<?php echo public_url('admin/images')?>/icons/color/edit.png">
						</a>
						
						<a href="<?php echo admin_url('BaiHat/del/').$row->maBaiHat ?>" class="tipS verify_action">
						    <img src="<?php echo public_url('admin/images')?>/icons/color/delete.png">
						</a>
					</td>
				</tr> 
				<?php endforeach; ?>       
		    </tbody>		
		</table>
	</div>	
</div>