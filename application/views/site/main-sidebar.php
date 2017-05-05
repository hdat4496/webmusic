    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/123.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Huỳnh Duy Anh Toàn</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->

        <li><a href="<?php echo base_url()?>Home/"><i class="glyphicon glyphicon glyphicon-home"></i> <span>Trang chủ</span></a></li>
        <li><a href="<?php echo base_url()?>site/Album/"><i class="glyphicon glyphicon-list-alt"></i> <span>Album</span></a></li>
        <li><a href="<?php echo base_url()?>site/ChartSong/"><i class="glyphicon glyphicon-th-list"></i> <span>Bảng xếp hạng</span></a></li>
        <li class="treeview">
          <a href="#"><i class="glyphicon glyphicon-eye-open"></i> <span>Quản lý</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="page/addsong.php">Thêm bài hát</a></li>
            <li><a href="page/addalbum.php">Thêm album</a></li>
            <li><a href="page/addartist.php">Thêm nghệ sỹ</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>