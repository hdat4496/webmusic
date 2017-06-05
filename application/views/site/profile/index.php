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
            </ul>
            <div class="tab-content">

              <div class="active tab-pane" id="baihatyeuthich">
              <?php   
                $this-> load-> model('BaiHat_model');
                $baihat_yeuthich = $this-> BaiHat_model->layDSBaiHatYeuThich($user_info->taiKhoan);
              ?>

              <?php foreach ($baihat_yeuthich as $row): ?>
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="<?php echo base_url('upload/img/'.$row['imageURL']) ?>" alt="user image">
                        <span class="username">
                    <a href="<?php echo base_url('site/playsong/play/'.$row['maBaiHat']) ?>" class="charts-song-title"><?php echo $row['tenBaiHat'] ?></a>
                        </span>
                    <span class="description">Soobin Hoàng Sơn</span>
                  </div>
                  <!-- /.user-block -->

                </div>
                <?php endforeach ?>
                <!-- Post -->
                                               
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
