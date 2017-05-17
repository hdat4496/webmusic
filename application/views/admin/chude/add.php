<!--head-->
<?php $this -> load -> view('admin/chude/head', $this-> data) ?>

<div class="line"></div>

<div class="wrapper">
	<div class="widget">
		<div class="title">
			<img src="<?php echo public_url('admin') ?>/images/icons/dark/add.png" class="titleIcon">
			<h6>Thêm mới chủ đề</h6>
		</div>
		<div class="tab_container">
		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>

				<div class="formRow">
					<label class="formLeft" for="param_tenChuDe">Tên chủ đề:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="tenChuDe" id="param_tenChuDe" _autocheck="true" value="<?php echo set_value('tenChuDe') ?>" type="text"></span>
						<span name="tenChuDe_autocheck" class="autocheck"></span>
						<div name="tenChuDe_error" class="clear error"><?php echo form_error('tenChuDe')?></div>
					</div>
					<div class="clear"></div>
				</div>


                 <div class="formRow">
                	<label for="param_name" class="formLeft">Nhóm chủ đề:</label>
                	<div class="formRight">
                		<span class="oneTwo">
                    		<select _autocheck="true" id="param_maNhomChuDe"  name="maNhomChuDe">
                    		     <?php foreach ($list as $row):?>
                    		       <option value="<?php echo $row->maNhomChuDe?>"><?php echo $row->tenNhomChuDe?></option>
                    		     <?php endforeach;?>
                    		</select>
                		</span>
                		<span class="autocheck" name="maNhomChuDe_autocheck"></span>
                		<div class="clear error" name="maNhomChuDe_error"><?php echo form_error('maNhomChuDe')?></div>
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