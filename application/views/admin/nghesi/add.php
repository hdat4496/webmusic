<!--head-->
<?php $this -> load -> view('admin/nghesi/head', $this-> data) ?>

<div class="line"></div>
<div class="wrapper">
 	   
<!-- Form -->
<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
<fieldset>
<div class="widget">
	<div class="title">
		<img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
		<h6>Thêm mới Nghệ sĩ</h6>
	</div>
						
<div class="tab_container">
	<div class="formRow">
		<label class="formLeft" for="param_name">Tên nghệ sĩ<span class="req">*</span></label>
		<div class="formRight">
			<span class="oneTwo"><input name="tenNgheSi" id="param_name" _autocheck="true" value="" type="text"></span>
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
				<img id="imageLoad" src="#" style="width: 260px;height: 260px;display: none;" alt="">
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
		<label class="formLeft" for="param_cat">Ngày sinh:<span class="req">*</span></label>
		<div class="formRight">
				<input style="width: 50%" name="ngaySinh" value="<?php echo date('d/m/Y')?>" type="text" class="datepicker" />
			<span name="cat_autocheck" class="autocheck"></span>
			
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label class="formLeft" for="param_cat">Giới tính:<span class="req">*</span></label>
		<div class="formRight">
				<select name="gioiTinh" class="left">	
                    <option value="Nữ" >Nữ</option>
                    <option value="Nam" >Nam</option>
                    <option value="Khác" >Khác</option>														    
				</select>
			<span name="cat_autocheck" class="autocheck"></span>
			<div name="cat_error" class="clear error"><?php echo form_error('gioiTinh')?></div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label class="formLeft" for="param_name">Tiểu sử:</label>
		<div class="formRight">
				<textarea name="tieuSu" id="param_content" class="editor"></textarea>
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

<!-- preview hình -->
<script type="text/javascript">
       function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imageLoad').attr('src', e.target.result);
                $('#imageLoad').css('display','block'); 
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#image").change(function(){
        readURL(this);
    });
</script>