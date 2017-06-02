      <!-- Logo -->
      <a href="<?php echo base_url()?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>M</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Music</b></span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="login" data-toggle="modal" data-target="#myModal">Đăng Nhập</a></li>
            <li><a href="#" class="login" data-toggle="modal" data-target="#myModal1" style="padding-right: 25px;">Đăng Ký</a></li>
          </ul>
         <div class="col-xs-5 col-xs-offset-2" id="search">
            <div class="input-group">
                  <div class="input-group-btn search-panel">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span id="search_concept">Tất cả</span> <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#contains">Bài hát</a></li>
                        <li><a href="#its_equal">Album</a></li>
                        <li><a href="#greather_than">Nghệ sĩ</a></li>
                        <li class="divider"></li>
                        <li><a href="#all">Tất cả</a></li>
                      </ul>
                  </div>
                  <input type="hidden" name="search_param" value="all" id="search_param">         
                  <input type="text" class="form-control" name="x" placeholder="Tìm kiếm">
                  <span class="input-group-btn">
                      <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                  </span>
              </div>
          </div>
      </nav>