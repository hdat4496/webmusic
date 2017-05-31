<!--head-->
<?php $this -> load -> view('admin/baihat/head', $this-> data) ?>

<div class="line"></div>
<div class="wrapper">
 	   
<!-- Form -->
<form class="form" id="form" action="<?php echo admin_url('BaiHat/add')?>" method="post" enctype="multipart/form-data">
<fieldset>
<div class="widget">
	<div class="title">
		<img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
		<h6>Thêm mới Bài hát</h6>
	</div>
						
<div class="tab_container">
	<div class="formRow">
		<label class="formLeft" for="param_name">Tên bài hát:<span class="req">*</span></label>
		<div class="formRight">
			<span class="oneTwo"><input name="tenBaiHat" id="param_name" _autocheck="true" type="text"></span>
			<span name="name_autocheck" class="autocheck"></span>
			<div name="name_error" class="clear error"><?php echo form_error('tenBaiHat')?></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label class="formLeft">Audio:<span class="req">*</span></label>
		<div class="formRight">
			<div class="left">
				<input type="file" id="image" name="audio">
			</div>
			<div name="audio_error" class="clear error"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label class="formLeft">Hình ảnh:<span class="req">*</span></label>
		<div class="formRight">
			<div class="left">
				<input type="file" id="image" name="image">
			</div>
			<div name="image_error" class="clear error"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label class="formLeft" for="param_cat">Quốc gia:<span class="req">*</span></label>
		<div class="formRight">
				<select name="quocGia" class="left">
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
		<label class="formLeft" for="param_name">Lời bài hát:<span class="req">*</span></label>
		<div class="formRight">
				<textarea name="loiBaiHat" id="param_content" class="editor"></textarea>
				<div name="content_error" class="clear error"></div>

		</div>
		<div class="clear"></div>
	</div>
	 	 					        
	<div class="formRow hide"></div>
					
</div><!-- End tab_container-->
	        		
	        		<div class="formSubmit">
	           			<input type="submit" value="Thêm mới" class="redB oncl">
	           		</div>
	        		<div class="clear"></div>
				</div>
			</fieldset>
		</form>
</div>
<div class="clear mt30"></div>