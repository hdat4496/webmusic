<!-- head -->
<?php $this->load->view('admin/slide/head', $this->data)?>

<div class="line"></div>

<div class="wrapper">
	   	<!-- Form -->
		<form enctype="multipart/form-data" method="post" action="" id="form" class="form">
			<fieldset>
				<div class="widget">
				    <div class="title">
						<img class="titleIcon" src="<?php echo public_url('admin')?>/images/icons/dark/add.png">
						<h6>Cập nhật Slide</h6>
					</div>
					
				    <ul class="tabs">
		                <li class="activeTab"><a href="#tab1">Thông tin chung</a></li>
					</ul>
					
					<div class="tab_container">
					     <div class="tab_content pd0" id="tab1" style="display: block;">
					         <div class="formRow">
                            	<label for="param_name" class="formLeft">Tên slide<span class="req">*</span></label>
                            	<div class="formRight">
                            		<span class="oneTwo"><input type="text" _autocheck="true" id="param_name" value="<?php echo $Slide->tenSlide?>" name="tenSlide"></span>
                            		<span class="autocheck" name="name_autocheck"></span>
                            		<div class="clear error" name="name_error"></div>
                            	</div>
                            	<div class="clear"></div>
                            </div>
                            
                            <div class="formRow">
                            	<label class="formLeft">Hình ảnh:<span class="req">*</span></label>
                            	<div class="formRight">
                            		<div class="left">
                                        <input type="file" id="image" name="image">
                            		</div>
                            		<div class="clear error" name="image_error"></div>
                                    <img id="imageLoad" src="<?php echo base_url('upload/slide/'.$Slide->imageURL)?>" style="width: 260px;height: 260px" alt="">
                            	</div>
                            	<div class="clear"></div>
                            </div>
                             
                               <div class="formRow">
                            	<label for="param_name" class="formLeft">Link:</label>
                            	<div class="formRight">
                            		<span class="oneTwo"><input type="text" _autocheck="true" id="param_link" value="<?php echo $Slide->url?>" name="url"></span>
                            		<span class="autocheck" name="name_autocheck"></span>
                            		<div class="clear error" name="name_error"></div>
                            	</div>
                            	<div class="clear"></div>
                            </div>
                            
                             <div class="formRow">
                            	<label for="param_name" class="formLeft">Mô tả:</label>
                            	<div class="formRight">
                            		<span class="oneTwo"><input type="text" _autocheck="true" id="param_info" value="<?php echo $Slide->info?>" name="info"></span>
                            		<span class="autocheck" name="name_autocheck"></span>
                            		<div class="clear error" name="name_error"></div>
                            	</div>
                            	<div class="clear"></div>
                            </div>
                            
                            <div class="formRow">
                            	<label for="param_name" class="formLeft">Thứ tự hiển thị:</label>
                            	<div class="formRight">
                            		<span class="oneTwo"><input type="text" _autocheck="true" id="param_sort_order" value="<?php echo $Slide->thuTuHienThi?>" name="thuTuHienThi"></span>
                            		<span class="autocheck" name="name_autocheck"></span>
                            		<div class="clear error" name="name_error"></div>
                            	</div>
                            	<div class="clear"></div>
                            </div>
                            
                            
				         <div class="formRow hide"></div>
						 </div>
						
						
	        		</div><!-- End tab_container-->
	        		
	        		<div class="formSubmit">
	           			<input type="submit" class="redB" value="Cập nhật">
	           			<input type="reset" class="basic" value="Hủy bỏ">
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