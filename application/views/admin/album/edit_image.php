<!--head-->
<?php $this -> load -> view('admin/album/head', $this-> data) ?>

<div class="line"></div>
<div class="wrapper">
 	   
<!-- Form -->
<form class="form" id="form" action="<?php echo admin_url('Album/edit_image_perform/').$album->maAlbum?>" method="post" enctype="multipart/form-data">
<div>
<div class="widget">
	<div class="title">
		<img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
		<h6>Cập nhật hình ảnh album</h6>
	</div>
						
<div class="tab_container">
	<div class="formRow">
		<label class="formLeft">Hình ảnh:<span class="req">*</span></label>
		<div class="formRight">
			<div class="left">
				<input type="file" id="image" name="image">

			</div>
			<div name="image_error" class="clear error"></div>
			<img id="imageLoad" src="<?php echo base_url('upload/img/'.$album->imageURL)?>" style="width: 260px;height: 260px" alt="">
		</div>

		<div class="clear"></div>
	</div>
					
</div><!-- End tab_container-->
	        		
	        		<div class="formSubmit">
	           			<input type="submit" value="Cập nhật" class="redB oncl">
	           		</div>
	        		<div class="clear"></div>
				</div>
			</div>
		</div>
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