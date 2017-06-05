<section class="hbox stretch">
  <section class="content">
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3" ">

          <!-- Profile Image -->
          <div class="box box-primary info-left">
            <div class="box-body box-profile">
              <img style="width: 100px;height: 100px;" class="profile-user-img img-responsive img-circle" src="<?php echo base_url('upload/img/'.$ngheSi->imageURL) ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $ngheSi->tenNgheSi?></h3>

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
              <strong><i class="fa fa-desktop margin-r-5"></i>Tiểu sử</strong>

              <p class="text-muted">
                <?php echo $ngheSi->tieuSu ?>
              </p>

              <hr>
              <strong><i class="fa fa-birthday-cake margin-r-5"></i>Ngày sinh</strong>
              
              <p class="text-muted">
             <?php echo $ngheSi->ngaySinh ?>
              </p>

              <hr>
              <strong><i class="fa fa-venus-mars margin-r-5"></i> Giới tính</strong>
              <p class="text-muted">     <?php echo $ngheSi->gioiTinh ?></p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#danhsachbaihat" data-toggle="tab">Danh sách bài hát</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="danhsachbaihat">

                 <!-- Post -->
                 <?php foreach ($DSBaiHat as $row): ?>
                    <div class="post">
                    <span >
                      <div class="user-block" style="margin-bottom: 5px;">
                        <img class="img-circle img-bordered-sm" src="<?php echo base_url('upload/img/'.$row['imageURL']) ?>" alt="">
                      <span class="username">
                        <a href="<?php echo base_url('site/playsong/play/'.$row['maBaiHat']) ?>" class="charts-song-title" style="margin-top: 10px;"><?php echo $row['tenBaiHat'] ?></a>
                      </span>
                      <span class="pull-right description text-muted col-md-4"><i class="fa fa-headphones"></i> &nbsp;&nbsp;<?php echo $row['luotNghe'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa  fa-download">&nbsp;&nbsp;<?php echo $row['luotTai'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i> <i class="fa fa-thumbs-o-up">&nbsp;&nbsp;<?php echo $row['luotThich'] ?></i></span> 
                      
                      </div>
                      <!-- /.user-block -->
                      </span>
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
