<section class="content">
  <!--slider-->
<div class="col-md-9">
  <div class="container col-md-12" id="slider">
        <div id="main_area">
                <!-- Slider -->
                <div class="row ">
                    <div class="col-xs-12" >
                        <!-- Top part of the slider -->
                        <div class="row ">
                            <div class="col-sm-12" id="carousel-bounding-box">
                                <div class="carousel slide col-md-12" id="myCarousel">
                                    <!-- Carousel items -->
                                    <div class="carousel-inner col-md-12" id="carousel-inner">
                                    <?php foreach ($slide_list as $row): ?>
                                      <?php $x=$row-> thuTuHienThi ?>
                                        <div class="<?php if($x==1){
                                          echo 'active item';
                                          } else{echo 'item';} ?>" data-slide-number="<?php echo $x; ?>">
                                        <a href="<?php echo $row->url ?>"><img src="<?php echo base_url('upload/slide/'.$row->imageURL)?>"></div></a>
                                  <?php endforeach ?>
                                    </div><!-- Carousel nav -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"></span>                                       
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"></span>                                       
                                    </a>                                
                                    </div>
                            </div>

                        </div>
                    </div>
                </div><!--/Slider-->

                <div class="row" id="slider-thumbs">
                        <!-- Bottom switcher of slider -->
                        <ul class="hide-bullets">              
                      <?php foreach ($slide_list as $row): ?>
                          <?php $y=$row->thuTuHienThi;
                          $y--; ?>

                            <li class="col-sm-3">
                                <a class="thumbnail" id="carousel-selector-<?php echo $y ?>"> <img src="<?php echo base_url('upload/slide/'.$row->imageURL)?>"></a>
                            </li>
                        <?php endforeach ?>

                        </ul>                 
                </div>
        </div>
  </div>
<!--NEW SONG-->
<div class="col-md-8" id="new-song">
<h2 class="font-light">Bài hát mới</h2>
    <div class="row row-sm list-group">
      <?php foreach ($baihat_new as $row): ?>
        <div class="col-xs-6 col-sm-3">
            <div class="thumbnail">
            <div class="pos-rlt">
              <div class="item-overlay opacity r-2x bg-black">
              <div class="center text-center m-t-n">
              <a href="#">
                <i class="fa fa-play-circle i-2x"></i>
              </a>
              </div>
              </div>
              <a href="<?php echo base_url('site/playsong/play/'.$row->maBaiHat) ?>">
                <img class="group list-group-image img-full" src="<?php  echo base_url('upload/img/'.$row->imageURL)?> " alt class="r r-2x img-full" />
                </a> 
              </div>          
                <div class="caption">
                    <a href="<?php echo base_url('site/playsong/play/'.$row->maBaiHat) ?>" class="song-name"><?php echo $row->tenBaiHat ?></a>
                    <?php foreach ($nghesi as $i): ?>
                      <?php if ($i->maBaiHat == $row ->maBaiHat): ?>
                         <a href="#" class="singer-name"><?php echo $i->ngheSi ?></a>       
                      <?php endif ?>

                     <?php endforeach ?>
                </div>

            </div>
        </div>
   
      <?php endforeach ?>
    </div>
</div>

<!--CHARTS SONG-->
  <div class="col-md-4" id="charts-song">
  <h2 class="font-light">Bảng xếp hạng</h2>

          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs nav-justified">
              <li class="active"><a href="#viet-nam" data-toggle="tab">Việt Nam</a></li>
              <li><a href="#au-my" data-toggle="tab">&nbsp; Âu Mỹ  &nbsp;</a></li>
              <li><a href="#han-quoc" data-toggle="tab">Hàn Quốc</a></li>
            </ul>
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
                <?php endforeach  ?>     
                <!-- /.item -->            
              </ul>
            </div>
            <!-- /.box-body -->

              </div>
              <!-- /.tab-pane -->

              <!-- Charts-song Âu Mỹ-->
              <div class="tab-pane" id="au-my">
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
                <?php endforeach  ?>     
                <!-- /.item -->            
              </ul>
            </div>
            <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">Nghe tất cả</a>
                </div>

              </div>
              <!-- /.tab-pane -->

              <!-- Charts-song Hàn Quốc-->
              <div class="tab-pane" id="han-quoc">
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
                <?php endforeach  ?>     
                <!-- /.item -->            
              </ul>
            </div>
            <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">Nghe tất cả</a>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
    </div>
</div>

    <div class="row">
      <!-- TOP TREND -->
      <div class="col-md-3" id="top-trend">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Bài hát thịnh hành</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="box-header-toptrend">
              <ul class="toptrend-list toptrend-list-in-box">

                <?php foreach ($toptrend as $row): ?>
                  <li class="item">
                    <div class="toptrend-img">
                      <img src=" <?php echo base_url('upload/img/'.$row->imageURL) ?>" alt="toptrend Image">
                    </div>
                    <div class="toptrend-info">
                      <a href=" <?php echo base_url('site/playsong/play/'.$row->maBaiHat) ?>" class="toptrend-title"><?php echo $row->tenBaiHat ?></a>

                    <?php foreach ($nghesi as $i): ?>
                      <?php if ($i->maBaiHat == $row ->maBaiHat): ?>
                        <span class="toptrend-description">
                          <?php echo $i->ngheSi ?>
                        </span>     
                      <?php endif ?>
                     <?php endforeach ?>

                    </div>
                  </li>
              <?php endforeach ?>

                <!-- /.item -->               
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- Your Page Content Here -->
    </section>
    <!-- /.content -->
      <script src="<?php echo public_url()?>js/jquery-1.7.2.min.js"></script>
      <script src="<?php echo public_url()?>js/js.js"></script>
      <script src="<?php echo public_url()?>js/bootstrap.min.js"></script>
      <script src="<?php echo public_url()?>js/app.min.js"></script>
      <script src="<?php echo public_url()?>js/jquery-ui-1.8.17.custom.min.js"></script>
