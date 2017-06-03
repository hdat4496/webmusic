<section class="hbox stretch">
  <section class="content">
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3" ">

          <!-- Profile Image -->
          <div class="box box-primary info-left">
            <div class="box-body box-profile">
              <img style="width: 100px;height: 100px;" class="profile-user-img img-responsive img-circle" src="<?php echo base_url('upload/img/'.$user_info->imageURL)?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $user_info->hoTen?></h3>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary info-left">
            <div class="box-header with-border">
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-suitcase margin-r-5"></i>Email</strong>

              <p class="text-muted">
                <?php echo $user_info->email?>
              </p>

              <hr>

              <strong><i class="fa fa-venus-mars margin-r-5"></i> Giới tính</strong>
              <p class="text-muted"><?php echo $user_info->gioiTinh?></p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#baihatyeuthich" data-toggle="tab">Bài hát yêu thích</a></li>
              <li><a href="#playlistcanhan" data-toggle="tab">Playlist cá nhân</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="baihatyeuthich">
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../dist/img/phia-sau-mot-co-gai.png" alt="user image">
                        <span class="username">
                    <a href="javascript:void(0)" class="charts-song-title">Phía sau một cô gái</a>
                        </span>
                    <span class="description">Soobin Hoàng Sơn</span>
                  </div>
                  <!-- /.user-block -->
                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                  </ul>
                </div>

                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../dist/img/noi-nay-co-anh.jpg" alt="user image">
                        <span class="username">
                    <a href="javascript:void(0)" class="charts-song-title">Nơi này có anh</a>
                        </span>
                    <span class="description">Sơn Tùng MTP</span>
                  </div>
                  <!-- /.user-block -->
                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                  </ul>
                </div>

                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../dist/img/di-de-tro-ve.jpg" alt="user image">
                        <span class="username">
                    <a href="javascript:void(0)" class="charts-song-title">Đi để trở về</a>
                        </span>
                    <span class="description">Soobin Hoàng Sơn</span>
                  </div>
                  <!-- /.user-block -->
                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                  </ul>
                </div>

                 <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../dist/img/anh-da-quen-voi-co-don.jpg" alt="user image">
                        <span class="username">
                    <a href="javascript:void(0)" class="charts-song-title">Anh đã quen với cô đơn</a>
                        </span>
                    <span class="description">Soobin Hoàng Sơn</span>
                  </div>
                  <!-- /.user-block -->
                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                  </ul>
                </div>                                               
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="playlistcanhan">
               <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../dist/img/anh-nang-cua-anh.jpg" alt="user image">
                        <span class="username">
                    <a href="javascript:void(0)" class="charts-song-title">Ánh nắng của anh</a>
                        </span>
                    <span class="description">Đức Phúc</span>
                  </div>
                  <!-- /.user-block -->
                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                  </ul>
                </div>

                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../dist/img/shape-of-you.jpg" alt="user image">
                        <span class="username">
                    <a href="javascript:void(0)" class="charts-song-title">Shape Of You</a>
                        </span>
                    <span class="description">  Ed Sheeran</span>
                  </div>
                  <!-- /.user-block -->
                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                  </ul>
                </div>

                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../dist/img/Kendrick-Lamar.jpg" alt="user image">
                        <span class="username">
                    <a href="javascript:void(0)" class="charts-song-title">HUMBLE</a>
                        </span>
                    <span class="description">Kendrick Lamar</span>
                  </div>
                  <!-- /.user-block -->
                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                  </ul>
                </div>

                 <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../dist/img/Bruno-Mars.jpg" alt="user image">
                        <span class="username">
                    <a href="javascript:void(0)" class="charts-song-title">That's What I Like</a>
                        </span>
                    <span class="description">Bruno Mars</span>
                  </div>
                  <!-- /.user-block -->
                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                  </ul>
                </div>                          
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </section>
</section>

      <script src="<?php echo public_url()?>js/jquery-1.7.2.min.js"></script>
      <script src="<?php echo public_url()?>js/js.js"></script>
      <script src="<?php echo public_url()?>js/bootstrap.min.js"></script>
      <script src="<?php echo public_url()?>js/app.min.js"></script>
      <script src="<?php echo public_url()?>js/jquery-ui-1.8.17.custom.min.js"></script>
