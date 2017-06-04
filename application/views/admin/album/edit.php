<!--head-->
<?php $this -> load -> view('admin/album/head', $this-> data) ?>

<div class="line"></div>
<div class="wrapper">
 	   
<!-- Form -->
<div class="form" id="form" enctype="multipart/form-data">
<fieldset>
<div class="widget">
	<div class="title">
		<img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
		<h6>Cập nhật album</h6>
	</div>
						
<div class="tab_container">
	<div class="formRow">
		<label class="formLeft" for="param_name">Tên alum<span class="req">*</span></label>
		<div class="formRight">
			<span class="oneTwo"><input name="tenAlbum" id="tenAlbum" _autocheck="true" value="<?php echo $album->tenAlbum ?>" type="text"></span>
			<span name="name_autocheck" class="autocheck"></span>
			<div name="name_error" class="clear error"></div>
		</div>
		<div class="clear"></div>
	</div>


	<div class="formRow">
		<label class="formLeft" for="param_cat">Quốc gia:<span class="req">*</span></label>
		<div class="formRight">
				<select name="quocGia" class="left" id="quocGia">
					<?php foreach ($quocgia as $row): ?>	
                    		       <option value="<?php echo $row->maQuocGia?>" <?php echo ($row->maQuocGia == $album->maQuocGia) ? 'selected' : '';?>><?php echo $row->tenQuocGia?></option>
					<?php endforeach; ?>															    
				</select>
			<span name="cat_autocheck" class="autocheck"></span>
			<div name="cat_error" class="clear error"></div>
		</div>
		<div class="clear"></div>
	</div>


	<div class="formRow">
		<label class="formLeft" for="param_cat">Chủ đề:<span class="req">*</span></label>
		<div class="formRight">
				<select _autocheck="true" id="chuDe" name="chuDe" class="left">
					<option value=""></option>	
					<?php foreach ($chude as $row): ?>	
						<option value="<?php echo $row->maChuDe?>"><?php echo $row->tenChuDe ?></option>}
					<?php endforeach; ?>															    
				</select>
				<a  href="javascript:void(0)">
					<img src="<?php echo public_url('admin')?>/images/icons/control/16/add.png" onclick="add_chude()" style="margin:6px 0 0 6px;">
	 			</a>
				<div id="list_chude">	
	        		<?php foreach ($listCD as $key => $value): ?>
				 		<span class="list_option" id="item_<?php echo $value["maChuDe"]; ?>"><?php echo $value["tenChuDe"]; ?>
					 		<a href="javascript:void(0)" onclick="delete_chude('<?php echo $value["maChuDe"]; ?>')">
					 			 <img style="margin: 6px 0 0 6px" width="10px" height="10px" src="<?php echo public_url('admin/images')?>/icons/color/delete.png">
					 		 </a>
				 		 </span>
	        		<?php endforeach ?>
				</div>
			<span name="cat_autocheck" class="autocheck"></span>

		</div>
		<div class="clear"></div>
	</div>
	<div id="maAlbum" value="" style="display: none;"><?php  echo $album->maAlbum ?></div>
	 	 					        
	<div class="formRow hide"></div>
					
</div><!-- End tab_container-->
	        		
	        		<div class="formSubmit">
	           			<input type="submit" value="Cập nhật" class="redB oncl" onclick="load_ajax_edit()">
	           		</div>
	        		<div class="clear"></div>
				</div>
			</fieldset>
		</div>
</div>
<div class="clear mt30"></div>

