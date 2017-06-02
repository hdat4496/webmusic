<!--head-->
<?php $this -> load -> view('admin/nguoidung/head', $this-> data) ?>

<div class="line"></div>

<div class="wrapper">
	<div class="widget">
		<div class="title">
			<img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
			<h6>Thêm mới tài khoản</h6>
		</div>
		<div class="tab_container">
		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>

				<div class="formRow">
					<label class="formLeft" for="param_hoTen">Họ tên:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="hoTen" id="param_hoTen" _autocheck="true" value="<?php echo set_value('hoTen') ?>" type="text"></span>
						<span name="hoTen_autocheck" class="autocheck"></span>
						<div name="hoTen_error" class="clear error"><?php echo form_error('hoTen')?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_cat">Giới tính:<span class="req">*</span></label>
					<div class="formRight">
						<select name="gioiTinh" _autocheck="true" id="param_gioiTinh" class="left">
							<option value="Nam">Nam</option>
							<option value="Nữ">Nữ</option>      
						</select>
						<span name="cat_autocheck" class="autocheck"></span>
						<div name="cat_error" class="clear error"></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_taiKhoan">Tên tài khoản:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="taiKhoan" id="param_taiKhoan" _autocheck="true" value="<?php echo set_value('taiKhoan') ?>" type="text"></span>
						<span name="taiKhoan_autocheck" class="autocheck"></span>
						<div name="taiKhoan_error" class="clear error"><?php echo form_error('taiKhoan')?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_matKhau">Mật khẩu:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="matKhau" id="param_matKhau" _autocheck="true" type="password"></span>
						<span name="matKhau_autocheck" class="autocheck"></span>
						<div name="matKhau_error" class="clear error"><?php echo form_error('matKhau')?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_nhapLai_MatKhau">Nhập lại mật khẩu:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="nhapLai_MatKhau" id="param_nhaplai_matKhau" _autocheck="true" type="password"></span>
						<span name="nhapLai_MatKhau_autocheck" class="autocheck"></span>
						<div name="nhapLai_MatKhau_error" class="clear error"><?php echo form_error('nhapLai_MatKhau')?></div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow">
					<label class="formLeft" for="param_email">Email:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="email" id="param_email" _autocheck="true" value="<?php echo set_value('email') ?>" type="text"></span>
						<span name="email_autocheck" class="autocheck"></span>
						<div name="email_error" class="clear error"><?php echo form_error('email')?></div>
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
				
				<div class="formSubmit"> 
	           			<input type="submit" value="Thêm mới" class="redB">
	           	</div>
				<div class="clear"></div>

			</fieldset>
		</form>
	</div>
</div>

</div>

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