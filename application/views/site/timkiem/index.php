<section class="hbox stretch">
  <section class="content">
    <!-- Main content -->
    <section class="content">

        <!-- /.col -->
        <div class="col-md-10">
          <h2>Kết quả tìm kiếm cho "<?php echo $noiDung ?>"</h2>
          <div class="nav-tabs-custom">

            <div class="tab-content">
            <?php if ($_POST["timkiem"]=='baihat'): ?>
                <?php if ($ketQua): ?>
                  <?php foreach ($ketQua as $row): ?>
                 <!-- Post -->
                <div class="post">
                <span >
                  <div class="user-block" style="margin-bottom: 5px;">
                    <img class="img-circle img-bordered-sm" src="../dist/img/anh-da-quen-voi-co-don.jpg" alt="user image">
                  <span class="username">
                    <a href="<?php echo base_url('site/playsong/play/'.$row->maBaiHat) ?>" class="charts-song-title" style="margin-top: 10px;"><?php echo $row->tenBaiHat?></a>
                  </span>
                  <span class="pull-right description text-muted col-md-3"><i class="fa fa-headphones"></i>&nbsp;&nbsp;<?php echo $row->luotNghe ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa  fa-download"> <?php echo $row->luotTai ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i> <i class="fa fa-thumbs-o-up">&nbsp;&nbsp; <?php echo $row->luotThich ?></i></span> 
                    <?php foreach ($nghesi as $i): ?>
                      <?php if ($i->maBaiHat == $row ->maBaiHat): ?>
                        <span class="description" style="margin-top: 10px;">
                          <?php echo $i->ngheSi ?>
                        </span>     
                      <?php endif ?>

                     <?php endforeach ?>


                  </div>
                  <!-- /.user-block -->
                  </span>
                </div>   
                 <!-- Post -->
              <?php endforeach ?>
      <?php else: ?>
        Không tìm thấy kết quả
      <?php endif; ?>
              
      <?php elseif  ($_POST["timkiem"]=='album'): ?>
<?php if ($ketQua): ?>
                  <?php foreach ($ketQua as $row): ?>
                 <!-- Post -->
                <div class="post">
                <span >
                  <div class="user-block" style="margin-bottom: 5px;">
                    <img class="img-circle img-bordered-sm" src="../dist/img/anh-da-quen-voi-co-don.jpg" alt="user image">
                  <span class="username">
                    <a href="javascript:void(0)" class="charts-song-title" style="margin-top: 10px;"><?php echo $row->tenAlbum?></a>
                  </span>
                  <span class="pull-right description text-muted col-md-2"><i class="fa fa-headphones"></i>&nbsp;&nbsp;<?php echo $row->luotNghe ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                    <span class="description" style="margin-top: 10px;">Soobin Hoàng Sơn</span>

                  </div>
                  <!-- /.user-block -->
                  </span>
                </div>   
                 <!-- Post -->
              <?php endforeach ?>
      <?php else: ?>
        Không tìm thấy kết quả
      <?php endif; ?>
      <?php elseif  ($_POST["timkiem"]=='nghesi'): ?>
<?php if ($ketQua): ?>
                  <?php foreach ($ketQua as $row): ?>
                 <!-- Post -->
                <div class="post">
                <span >
                  <div class="user-block" style="margin-bottom: 5px;">
                    <img class="img-circle img-bordered-sm" src="../dist/img/anh-da-quen-voi-co-don.jpg" alt="user image">
                  <span class="username">
                    <a href="<?php echo base_url('site/ThongTinNgheSi/ThongTin/'.$row->maNgheSi) ?>" class="charts-song-title" style="margin-top: 10px;"><?php echo $row->tenNgheSi?></a>
                  </span>



                  </div>
                  <!-- /.user-block -->
                  </span>
                </div>   
                 <!-- Post -->
              <?php endforeach ?>
      <?php else: ?>
        Không tìm thấy kết quả
      <?php endif; ?>
      <?php endif; ?>
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
