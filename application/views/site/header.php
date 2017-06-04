      <!-- Logo -->
      <a href="<?php echo base_url()?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>M</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Music</b></span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" style="height: 30px" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
         <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">       
          <ul class="nav navbar-nav">
          <?php if(isset($user_info)): ?>
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?php echo base_url('upload/img/'.$user_info->imageURL)?>" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo $user_info->hoTen ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?php echo base_url('upload/img/'.$user_info->imageURL)?>" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $user_info->hoTen ?>
                    
                  </p>
                </li>

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo base_url()?>site/Profile/" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url('User/logout') ?>" class="btn btn-default btn-flat">Đăng xuất</a>
                  </div>
                </li>
              </ul>
            </li>       
          <?php else: ?>
            <li><a href="#" class="login" data-toggle="modal" data-target="#myModal">Đăng Nhập</a></li>
            <li><a href="#" class="login" data-toggle="modal" data-target="#myModal1" style="padding-right: 25px;">Đăng Ký</a>
            </li>
          <?php endif; ?>
          </ul>
          </div>
          <form action="<?php echo base_url('TimKiem') ?>" method="POST" accept-charset="utf-8">
         <div class="col-xs-5 col-xs-offset-2" id="search">
            <div class="input-group" style="width: 100%">
                <div class="form-group">
                    <select class="form-control" id="timkiem" name='timkiem' style="width: 23%;background-color: #f4f4f4;border-radius: 4px 0px 0px 4px;" >
                         <option value="baihat">Bài hát</option>
                         <option value="album">Album</option>
                         <option value="nghesi">Nghệ sĩ</option>
                     </select>

                <div class="input-group t-search-box" style="width:77%">
                    <input type="text" class="form-control" id="search" name="search" placeholder="Nhập từ khóa" name="q" >
                    <div class="input-group-btn">
                        <button class="btn btn-default" id="searchbtn" name="searchbtn" type="submit" value="1"><i class="glyphicon glyphicon-search"></i></button>
 
                    </div>
                </div>
                </div>      

              </div>
          </div>
         </form>
      </nav>

