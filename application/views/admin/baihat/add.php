<!--head-->
<?php $this -> load -> view('admin/baihat/head', $this-> data) ?>

<div class="line"></div>
<div class="wrapper">
 	   
<!-- Form -->
<div class="form" id="form">
<div>
<div class="widget">
	<div class="title">
		<img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
		<h6>Thêm mới Bài hát</h6>
	</div>

	<ul class="tabs">
		<li><a href="#tab1">Thông tin chung</a></li>
		<li><a href="#tab2">Sáng tác/Trình bày</a></li>
		<li><a href="#tab3">Lời bài hát</a></li>
	</ul>
						
<div class="tab_container">
<div id="tab1" class="tab_content pd0">
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
		<label class="formLeft" for="param_cat">Chủ đề:<span class="req">*</span></label>
		<div class="formRight">
				<select _autocheck="true" id="chuDe" name="chuDe" class="left">
					<option value=""></option>	
					<?php foreach ($chude as $row): ?>	
						<option value="<?php echo $row->maChuDe?>"><?php echo $row->tenChuDe ?></option>}
					<?php endforeach; ?>															    
				</select>
				<a  href="javascript:void(0)">
					<img src="http://localhost:8080/webmusic/public/admin/images/icons/control/16/add.png" onclick="add_chude()" style="margin:6px 0 0 6px;">
	 			</a>
				<div id="list_chude">				 
				</div>
			<span name="cat_autocheck" class="autocheck"></span>
			<div name="cat_error" class="clear error"><?php echo form_error('chuDe')?></div>
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
</div>
						 
<div id="tab2" class="tab_content pd0">
						     			
	<div class="formRow">
		<label class="formLeft" for="param_cat">Sáng tác:<span class="req">*</span></label>
		<div class="formRight">
				<select name="sangTac" id="sangTac" class="left">
					<option value=""></option>	
					<?php foreach ($nghesi as $row): ?>	
						<option value="<?php echo $row->maNgheSi?>"><?php echo $row->tenNgheSi ?></option>}
					<?php endforeach; ?>															    
				</select>
				<a  href="javascript:void(0)">
					<img src="http://localhost:8080/webmusic/public/admin/images/icons/control/16/add.png" onclick="add_sangtac()" style="margin:6px 0 0 6px;">
	 			</a>
				<div id="list_nhacsi">				 
				</div>

			<span name="cat_autocheck" class="autocheck"></span>
			<div name="cat_error" class="clear error"><?php echo form_error('sangTac')?></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label class="formLeft" for="param_cat">Trình bày:<span class="req">*</span></label>
		<div class="formRight">
				<select name="trinhBay" id="trinhBay" class="left">
					<option value=""></option>	
					<?php foreach ($nghesi as $row): ?>	
						<option value="<?php echo $row->maNgheSi?>"><?php echo $row->tenNgheSi ?></option>}
					<?php endforeach; ?>															    
				</select>
				<a  href="javascript:void(0)">
					<img src="http://localhost:8080/webmusic/public/admin/images/icons/control/16/add.png" onclick="add_trinhbay()" style="margin:6px 0 0 6px;">
	 			</a>
				<div id="list_casi">				 
				</div>
			<span name="cat_autocheck" class="autocheck"></span>
			<div name="cat_error" class="clear error"><?php echo form_error('trinhBay')?></div>
		</div>
		<div class="clear"></div>
	</div>


	<div class="formRow hide"></div>
</div>
						 
	<div id="tab3" class="tab_content pd0">

	</div>
</div><!-- End tab_container-->
	        		
	        		<div class="formSubmit">
	           			<input type="submit" value="Thêm mới" class="redB oncl" onclick="load_ajax()">
	           		</div>

	           		<div id="result">
	           			
	           		</div>
	        		<div class="clear"></div>
				</div>
			</div>
		</div>
</div>
<div class="clear mt30"></div>