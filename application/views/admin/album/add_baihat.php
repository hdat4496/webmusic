
<div class="wrapper" id="myModal">
	<div style="width: 65%;
	margin-left: 20%;
	margin-top: 6%;	border-radius: 10px; background: white; ">
	<a href="<?php echo admin_url('Album/view/').$maAlbum ?>" class="close">&times;</a>
	<div class="widget popup-add"  >	
		<h2 style="height: 30px; padding-top: 15px; padding-left: 15px; font-size: 18px;">THÊM BÀI HÁT</h2>
		<div class="line"></div>
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck"></span>
			<h6>Danh sách bài hát</h6>
		 	<div class="num f12">Số lượng: <b id="total"><?php echo $total_rows ?></b></div>
		</div>
		
		<table  cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
			
			<thead class="filter"><tr><td colspan="8">
				<form class="list_filter form" action="<?php echo admin_url('album/add_baihat/').$maAlbum ?>" method="get">
					<table cellpadding="0" cellspacing="0" width="100%"><tbody>
					
						<tr>
							<td class="label" style="width:55px;"><label for="filter_maBaiHat">Mã bài hát</label></td>
							<td class="item"><input name="maBaiHat" value="<?php echo $this -> input ->get('maBaiHat') ?>" id="filter_maBaiHat" type="text" style="width:115px;"></td>
							
							<td class="label" style="width:65px;"><label for="filter_id">Tên bài hát</label></td>
							<td class="item" style="width:185px;"><input name="tenBaiHat" value="<?php echo $this -> input ->get('tenBaiHat') ?>" id="filter_tenBaiHat" type="text" style="width:185px;"></td>
							
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
							<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('album/add_baihat/'.$maAlbum) ?>'; ">
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
								<a href="#submit_ver2" id="submit_ver2" class="button blueB" url="<?php echo admin_url('album/add_all_baihat_to_album/'.$maAlbum) ?>">
									<span style="color:white;">Thêm tất cả</span>
								</a>

							
						 </div>
							
					     <div class="pagination">
							<?php echo $this -> pagination -> create_links() ?>
			             </div>
					</td>
				</tr>
			</tfoot>
			
			<tbody class="list_item"  >
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
					<td class="textL">
							<?php   $this-> load-> model('BaiHat_model');
        							$nhacsi = $this-> BaiHat_model->layDSNhacSiBaiHat($row->maBaiHat);
        							foreach ($nhacsi as $key => $value) {
        								echo $value["tenNgheSi"].' <br> ';
        						    } 
        					?>
    				 </td>				
					<td class="textL">
							<?php   $this-> load-> model('BaiHat_model');
        							$casi = $this-> BaiHat_model->layDSCaSiBaiHat($row->maBaiHat);
        							foreach ($casi as $key => $value) {
        								echo $value["tenNgheSi"].' <br> ';
        						    }?>
        			</td>
					<td class="textC"><?php echo $row->ngayPhatHanh ?></td>
					<td class="option textC">
						<a href="<?php echo admin_url('album/add_baihat_to_album/').$maAlbum.'-'.$row->maBaiHat?>" title="Thêm" class="tipE">
							<img src="<?php echo public_url('admin/images')?>/icons/control/16/add.png">
						</a>
					</td>
				</tr> 
				<?php endforeach; ?>      
		    </tbody>
		    
		</table>
	</div>	
	</div>
</div>
