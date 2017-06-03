    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
    <?php if(isset($user_info)): ?>      
      <div class="user-panel">
        <div class="pull-left image">
          <img style="max-width: 50px;height: 50px;" src="<?php echo base_url('upload/img/'.$user_info->imageURL)?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user_info->hoTen?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <?php else: ?>
          <?php endif; ?>        
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->

        <li><a href="<?php echo base_url()?>Home/"><i class="glyphicon glyphicon glyphicon-home"></i> <span>Trang chủ</span></a></li>
        <li><a href="<?php echo base_url()?>site/Album/"><i class="glyphicon glyphicon-list-alt"></i> <span>Album</span></a></li>
        <li><a href="<?php echo base_url()?>site/ChartSong/"><i class="glyphicon glyphicon-th-list"></i> <span>Bảng xếp hạng</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>