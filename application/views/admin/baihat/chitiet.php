<!--head-->
<?php $this -> load -> view('admin/baihat/head', $this-> data) ?>

<div class="line"></div>
<div class="wrapper">
 	   
<!-- Form -->
<div class="form" id="form" enctype="multipart/form-data">
<div>
<div class="widget">
	<div class="title">
		<img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
		<h6>Thêm chi tiết Bài hát</h6>
	</div>
						
<div class="tab_container">


	<div class="formRow">
		<label class="formLeft" for="param_name">Mã bài hát:</label>
		<div class="formRight">
			<span class="oneTwo">

			<input style="background-color: #eee"  disabled name="maBaiHat" id="mabaihat" _autocheck="true" type="text"  value="<?php echo $baiHat -> maBaiHat ?>">
			</span>
			<span name="name_autocheck" class="autocheck"></span>
			<div name="name_error" class="clear error"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label class="formLeft" for="param_name">Tên bài hát:</label>
		<div class="formRight">
			<span class="oneTwo">

			<input style="background-color: #eee"  disabled name="tenBaiHat" id="tenbaihat" _autocheck="true" type="text"  value="<?php echo $baiHat -> tenBaiHat ?>">
			</span>
			<span name="name_autocheck" class="autocheck"></span>
			<div name="name_error" class="clear error"></div>
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
					<img src="<?php echo public_url('admin')?>/images/icons/control/16/add.png" onclick="add_sangtac()" style="margin:6px 0 0 6px;">
	 			</a>
				<div id="list_nhacsi">				 
				</div>

			<span name="cat_autocheck" class="autocheck"></span>

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
					<img src="<?php echo public_url('admin')?>/images/icons/control/16/add.png" onclick="add_trinhbay()" style="margin:6px 0 0 6px;">
	 			</a>
				<div id="list_casi">				 
				</div>
			<span name="cat_autocheck" class="autocheck"></span>

		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow hide"></div>
						
</div><!-- End tab_container-->
	        		
	        		<div class="formSubmit">
	           			<input type="submit" value="Thêm mới" class="redB oncl" onclick="load_ajax()">
	           		</div>
	        		<div class="clear"></div>
	           		<div id="result">
	           			
	           		</div>
	           	</div>
			</div>
		</div>
</div>
<div class="clear mt30"></div>