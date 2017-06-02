<!--head-->
<?php $this -> load -> view('admin/ngheSi/head', $this-> data) ?>

<div class="line"></div>
<div class="wrapper">
    
<!-- Form -->
<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
<fieldset>
<div class="widget">
	<div class="title">
		<img src="<?php echo public_url('admin') ?>/images/icons/dark/edit.png" class="titleIcon">
		<h6>Cập nhật Nghệ sĩ</h6>
	</div>
						
<div class="tab_container">
<div id="tab1" class="tab_content pd0">
	<div class="formRow">
		<label class="formLeft" for="param_name">Tên nghệ sĩ<span class="req">*</span></label>
		<div class="formRight">
			<span class="oneTwo"><input name="tenNgheSi" id="param_name" _autocheck="true" value="<?php echo $ngheSi->tenNgheSi  ?>" type="text"></span>
			<span name="name_autocheck" class="autocheck"></span>
			<div name="name_error" class="clear error"><?php echo form_error('tenNgheSi')?></div>
		</div>
		<div class="clear"></div>
	</div>


	<div class="formRow">
		<label class="formLeft">Hình ảnh:<span class="req">*</span></label>
		<div class="formRight">
			<div class="left">
				<input type="file" id="image" name="image">
				<img id="imageLoad" src="<?php echo base_url('upload/img/'.$ngheSi->imageURL)?>" style="width: 100px;height: 70px" alt="">
			</div>
			<div name="image_error" class="clear error"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label class="formLeft" for="param_cat">Quốc gia:<span class="req">*</span></label>
		<div class="formRight">
				<select name="quocGia" class="left">
					<?php foreach ($quocgia as $row): ?>	
                    		       <option value="<?php echo $row->maQuocGia?>" <?php echo ($row->maQuocGia == $ngheSi->maQuocGia) ? 'selected' : '';?>><?php echo $row->tenQuocGia?></option>
					<?php endforeach; ?>															    
				</select>
			<span name="cat_autocheck" class="autocheck"></span>
			<div name="cat_error" class="clear error"><?php echo form_error('quocGia')?></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label class="formLeft" for="param_cat">Ngày sinh:<span class="req">*</span></label>
		<div class="formRight">
				<input style="width: 50%" name="ngaySinh" value="<?php echo $ngheSi->ngaySinh ?>" type="text" class="datepicker" />
			<span name="cat_autocheck" class="autocheck"></span>
			
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label class="formLeft" for="param_cat">Giới tính:<span class="req">*</span></label>
		<div class="formRight">
				<select name="gioiTinh" class="left">	
                    <option value="Nữ" <?php if($ngheSi->gioiTinh == "Nữ") echo 'selected' ?>>Nữ</option>
                    <option value="Nam" <?php if($ngheSi->gioiTinh == "Nam") echo 'selected' ?>>Nam</option>
                    <option value="Khác" <?php if($ngheSi->gioiTinh == "Khác") echo 'selected' ?>>Khác</option>														    
				</select>
			<span name="cat_autocheck" class="autocheck"></span>
			<div name="cat_error" class="clear error"><?php echo form_error('gioiTinh')?></div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label class="formLeft" for="param_name">Tiểu sử:</label>
		<div class="formRight">
				<textarea name="tieuSu" id="param_content" class="editor"><?php echo $ngheSi->tieuSu ?></textarea>
				<div name="content_error" class="clear error"></div>

		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow hide"></div>
</div>
						 
</div><!-- End tab_container-->
	        		
	        		<div class="formSubmit">
	           			<input type="submit" value="Cập nhật" class="redB">
	           		</div>
	        		<div class="clear"></div>
				</div>
			</fieldset>
		</form>
</div>
<div class="clear mt30"></div>

<!-- preview hình -->
<script type="text/javascript">
       function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imageLoad').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#image").change(function(){
        readURL(this);
    });
</script>