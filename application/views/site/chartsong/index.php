<section class="hbox stretch">
  <section class="content">
  <div class="col-md-4">
  <h2 class="font-light">BXH bài hát Việt Nam</h2>

          <div class="nav-tabs-custom">

            <div class="tab-content">
           <!-- Charts-song Việt Nam-->
              <div class="tab-pane active" id="viet-nam">
              <div class="box-body-charts">
               <ul class="charts-song-list charts-song-list-in-box">


                <?php $x=0; ?>
                <?php foreach ($baihat_xephang_vn as $row): ?>
                <?php $x++; ?>

                <li class="item">
                  <div class="charts-song-img">
                    <img src="<?php echo base_url('upload/img/'.$row->imageURL) ?>" class="img-circle" alt="charts-song Image">
                  </div>
                  <div class="charts-song-info">
                    <a href="<?php echo base_url('site/playsong/play/'.$row->maBaiHat) ?>" class="charts-song-title"><?php echo $row->tenBaiHat; ?></a>
                     <span class="pull-right h4 text-muted col-md-1"><?php echo $x; ?></span>                   
                    <?php foreach ($nghesi as $i): ?>
                      <?php if ($i->maBaiHat == $row ->maBaiHat): ?>
                        <span class="charts-song-description">
                          <?php echo $i->ngheSi ?>
                        </span>     
                      <?php endif ?>

                     <?php endforeach ?>
                  </div>
                </li>
                <!-- /.item -->
                <?php endforeach  ?>           
              </ul>
            </div>
            <!-- /.box-body -->

              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
    </div>
     <div class="col-md-4">
  <h2 class="font-light">BXH bài hát Âu Mỹ</h2>

          <div class="nav-tabs-custom">

            <div class="tab-content">

         <!-- Charts-song Âu Mỹ-->
              <div class="tab-pane active" id="au-my">
               <div class="box-body-charts">
               <ul class="charts-song-list charts-song-list-in-box">

                <?php $y=0; ?>
                <?php foreach ($baihat_xephang_aumy as $row): ?>
                <?php $y++; ?>

                <li class="item">
                  <div class="charts-song-img">
                    <img src="<?php echo base_url('upload/img/'.$row->imageURL) ?>" class="img-circle" alt="charts-song Image">
                  </div>
                  <div class="charts-song-info">
                    <a href="<?php echo base_url('site/playsong/play/'.$row->maBaiHat) ?>" class="charts-song-title"><?php echo $row->tenBaiHat; ?></a>
                     <span class="pull-right h4 text-muted col-md-1"><?php echo $y; ?></span>                   
                    <?php foreach ($nghesi as $i): ?>
                      <?php if ($i->maBaiHat == $row ->maBaiHat): ?>
                        <span class="charts-song-description">
                          <?php echo $i->ngheSi ?>
                        </span>     
                      <?php endif ?>

                     <?php endforeach ?>
                  </div>
                </li>
                <!-- /.item -->
                <?php endforeach  ?>        
                <!-- /.item -->

                    
              </ul>
            </div>
            <!-- /.box-body -->

              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
    </div>
     <div class="col-md-4">
  <h2 class="font-light">BXH bài hát Hàn Quốc</h2>

          <div class="nav-tabs-custom">

            <div class="tab-content">

              <!-- Charts-song Hàn Quốc-->
              <div class="tab-pane active" id="han-quoc">
            <div class="box-body-charts">
               <ul class="charts-song-list charts-song-list-in-box">

                <?php $z=0; ?>
                <?php foreach ($baihat_xephang_hq as $row): ?>
                <?php $z++; ?>

                <li class="item">
                  <div class="charts-song-img">
                    <img src="<?php echo base_url('upload/img/'.$row->imageURL) ?>" class="img-circle" alt="charts-song Image">
                  </div>
                  <div class="charts-song-info">
                    <a href="<?php echo base_url('site/playsong/play/'.$row->maBaiHat) ?>" class="charts-song-title"><?php echo $row->tenBaiHat; ?></a>
                     <span class="pull-right h4 text-muted col-md-1"><?php echo $z; ?></span>                   
                    <?php foreach ($nghesi as $i): ?>
                      <?php if ($i->maBaiHat == $row ->maBaiHat): ?>
                        <span class="charts-song-description">
                          <?php echo $i->ngheSi ?>
                        </span>     
                      <?php endif ?>

                     <?php endforeach ?>
                  </div>
                </li>
                <!-- /.item -->
                <?php endforeach  ?>        
                <!-- /.item -->

                       
              </ul>
            </div>
            <!-- /.box-body -->

              </div>

            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
    </div>
    

  </section>
</section>

      <script src="<?php echo public_url()?>js/jquery-1.7.2.min.js"></script>
      <script src="<?php echo public_url()?>js/js.js"></script>
      <script src="<?php echo public_url()?>js/bootstrap.min.js"></script>
      <script src="<?php echo public_url()?>js/app.min.js"></script>
      <script src="<?php echo public_url()?>js/jquery-ui-1.8.17.custom.min.js"></script>
