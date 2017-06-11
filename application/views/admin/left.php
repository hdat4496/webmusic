<div id="leftSide" style="padding-top:30px;">
	<!-- Account panel -->				
	<div class="sideProfile">
		<a href="#" title="" class="profileFace"><img width="80px" height="80px" src="<?php 
		$url=$this -> session-> userdata('taiKhoan')->imageURL;
		echo base_url('upload/img/'.$url) 
		?>"></a>
		<br>
		<span><?php echo $this -> session-> userdata('taiKhoan')->taiKhoan; ?></span>
		<div class="clear"></div>
	</div>
	<div class="sidebarSep"></div>		    
	<!-- Left navigation -->
	<ul id="menu" class="nav">

		<li class="home">
			<a href="<?php echo admin_url()?>"  id="current">
				<span>Bảng điều khiển</span>
				<strong></strong>
			</a>
		</li>

		<li class="music">
			<a  href="<?php echo admin_url('BaiHat')?>" class="current">
				<span>Bài hát </span>
			</a>				
		</li>

		<li class="album">
			<a  href="<?php echo admin_url('Album')?>" class="current">
				<span>Album </span>
			</a>				
		</li>

		<li class="user">
			<a  href="<?php echo admin_url('NgheSi')?>" class="current">
				<span>Nghệ sĩ</span>
			</a>				
		</li>

		<li class="account">
			<a href="admin/account.html" class="exp inactive">
				<span>Tài khoản</span>
				<strong>2</strong>
			</a>	
			<ul class="sub" style="display: none;">
				<li>
					<a href="<?php echo admin_url('TaiKhoan')?>">Ban quản trị</a>
				</li>
				<li>
					<a href="<?php echo admin_url('NguoiDung')?>">Thành viên</a>
				</li>
			</ul>						
		</li>



		<li class="content">
			<a href="admin/content.html" class="exp inactive">
				<span>Nội dung</span>
				<strong>2</strong>
			</a>
			<ul class="sub" style="display: none;">
				<li>
					<a href="<?php echo admin_url('Slide')?>">Slide</a>
				</li>
				<li>
					<a href="<?php echo admin_url('ChuDe')?>">Chủ đề</a>
				</li>

			</ul>				
		</li>




	</ul>		
</div>
<div class="clear"></div>
