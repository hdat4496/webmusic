<!--head-->
<?php $this -> load -> view('admin/album/head', $this-> data) ?>

<div class="line"></div>
<div class="wrapper">
 	   
<!-- Form -->
<div class="form" id="form" enctype="multipart/form-data">
<div>
<div class="widget">
	<div class="title">
		<img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
		<h6>Thêm mới album</h6>
	</div>
						
<div class="tab_container">
	<div class="formRow">
		<label class="formLeft" for="param_name">Tên alum<span class="req">*</span></label>
		<div class="formRight">
			<span class="oneTwo"><input name="tenAlbum" id="tenAlbum" _autocheck="true" value="" type="text"></span>
			<span name="name_autocheck" class="autocheck"></span>
			<div name="name_error" class="clear error"><?php echo form_error('tenAlbum')?></div>
		</div>
		<div class="clear"></div>
	</div>


	<div class="formRow">
		<label class="formLeft" for="param_cat">Quốc gia:<span class="req">*</span></label>
		<div class="formRight">
				<select name="quocGia" class="left" id="quocGia">
					<option value=""></option>	
					<?php foreach ($quocgia as $row): ?>	
						<option value="<?php echo $row->maQuocGia?>"><?php echo $row->tenQuocGia ?></option>}
					<?php endforeach; ?>															    
				</select>
			<span name="cat_autocheck" class="autocheck"></span>
			<div name="cat_error" class="clear error"><?php echo form_error('quocGia')?></div>
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
				</div>
			<span name="cat_autocheck" class="autocheck"></span>

		</div>
		<div class="clear"></div>
	</div>

	
	 	 					        
	<div class="formRow hide"></div>
					
</div><!-- End tab_container-->
	        		
	        		<div class="formSubmit">
	           			<input type="submit" value="Thêm" class="redB oncl" onclick="load_ajax()">
	           		</div>
	        		<div class="clear"></div>
				</div>
			</div>
		</div>
</div>
<div class="clear mt30"></div>

