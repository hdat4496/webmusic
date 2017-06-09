  <section class="hbox stretch">
    <section class="content">
      <div  id="sidebar">
        <aside class="aside bg-light dk" style="background-color: #f2f4f8">
          <section class="vbox animated fadeInUp">
            <section claas="scrollable hover">
              <div class="list-group no-radius no-border no-bg m-t-n-xxs m-b-none auto" style="margin-bottom: -15px;    margin-top: -7px;">
                <?php foreach ($list_chude as $row):?>
                   <a href="<?php echo base_url('site/Album/view/'.$row->maChuDe) ?>" class="list-group-item"><?php echo $row ->tenChuDe ?></a>
                <?php endforeach; ?>        
             </div>  
            </section>
          </section>
        </aside>
       </div> 
<?php if (isset($list_baihat_album)): ?>
    <div class="col-md-9">
      <section id="album-list">
        <section class="vbox">
          <section class="scrollable padder-lg">
            <h2 class="font-thin" style="margin: 0 0 20px 10px"><?php echo $chuDe->tenChuDe ?></h2>
    <div class="row row-sm list-group">
      <?php foreach ($list_baihat_album as $row):?>
          <div class="item col-xs-6 col-sm-3"> 
            <div class="thumbnail"> 
              <div class="pos-rlt"> 
                <div class="item-overlay opacity r-2x bg-black"> 
                  <div class="center text-center m-t-n"> 
                    <a href="#"> 
                      <i class="fa fa-play-circle i-2x"></i>
                     </a> 
                  </div> 
                </div> 
                <a href="<?php echo base_url('site/PlayAlbum/play/'.$row['maAlbum']) ?>"> 
                  <img class="group list-group-image img-full" src="dist/img/da-tung-vo-gia.jpg" alt class="r r-2x img-full" /> 
                </a> 
              </div> 
            <div class="caption" style="margin-left: 10px"> 
              <a href="<?php echo base_url('site/PlayAlbum/play/'.$row['maAlbum']) ?>"><?php echo $row['tenAlbum'] ?></a> <a href="javascript:void(0)" class="singer-name">
              <?php foreach($nghesi as $i):
                if($i->maAlbum == $row['maAlbum']) echo $i->ngheSi;
              endforeach; ?> 
            </a>
           </div> 
          </div> 
        </div>
      <?php endforeach; ?>
        
    </div>
          </section>
        </section>
      </section>
      </div>
<?php endif ?>

    </section>
  </section>

        <script src="<?php echo public_url()?>js/jquery-1.7.2.min.js"></script>
      <script src="<?php echo public_url()?>js/js.js"></script>
      <script src="<?php echo public_url()?>js/bootstrap.min.js"></script>
      <script src="<?php echo public_url()?>js/app.min.js"></script>
      <script src="<?php echo public_url()?>js/jquery-ui-1.8.17.custom.min.js"></script>
