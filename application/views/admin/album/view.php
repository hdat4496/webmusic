<!--head-->
<?php $this -> load -> view('admin/album/head', $this-> data) ?>

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
				<form class="list_filter form" action="" method="get">
					<table cellpadding="0" cellspacing="0" width="100%"><tbody>
					
						<tr>
							<td class="label" style="width:55px;"><label for="filter_maBaiHat">Mã album:</label></td>
							<td class="item"><b><?php echo $info->maAlbum?></b></td>
							
							<td class="label" style="width:65px;"><label for="filter_id">Tên album:</label></td>
							<td class="item" style="width:185px;"><b><?php echo $info->tenAlbum?></b></td>
							
							<td class="label" style="width:60px;"><label for="filter_status">Trình bày:</label></td>
							<td class="item" style="width:185px;">
							<b>
							<?php foreach($nghesi as $i):
							if($i->maAlbum == $info->maAlbum) echo $i->ngheSi;
						endforeach; ?> 
							</b>
							</td>
							
							<td style="width:150px">
							<input type="button" class="button blueB" value="Cập nhật">
							</td>
							
						</tr>
					</tbody></table>
					<input type="button" name="maAlbum" style="display: none;"><?php echo $info->maAlbum?></input>
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
								<a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('Album/del_all_baihat/').$info->maAlbum ?>">
									<span style="color:white;">Xóa hết</span>
								</a>
						 </div>
						 <div class="list_action itemActions">
								<a href="<?php echo admin_url('Album/add_baihat/').$info->maAlbum ?>" id="add_baihat" class="button blueB" url="">
									<span style="color:white;">Thêm</span>
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
						<a href="<?php echo admin_url('Album/del_baihat/').$info->maAlbum.'-'.$row->maBaiHat ?>" class="tipS verify_action">
						    <img src="<?php echo public_url('admin/images')?>/icons/color/delete.png">
						</a>
					</td>
				</tr> 
				<?php endforeach; ?>       
		    </tbody>		
		</table>
	</div>	
</div>
