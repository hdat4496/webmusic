    <!-- Main content -->
    <section class="stretch" style="min-height: 576px">
<section class="content" style="background-color: #3b464d;min-height: 576px;">
  <section class="vbox">
    <section class="w-f-md" id="bjax-target">
      <section class="vbox">
      <section class="scrollable wrapper-lg">
        <div class="row">
        <div class="col-sm-8">

        <div class="panel wrapper-lg pos-rlt" style="background-color: #222d32">
        <div class="row pos-rlt">

   
<div id="background"></div>
<div id="player">
  <div class="cover"></div>
  <div class="ctrl">
    <div class="tag">
      <strong>Title</strong>
      <span class="artist">Artist</span>
      <span class="album">Album</span>
    </div>
    <div class="control">
      <div class="left">
        <div class="rewind icon"></div>
        <div class="playback icon"></div>
        <div class="fastforward icon"></div>
      </div>
      <div class="volume right">
        <div class="mute icon left"></div>
        <div class="slider left">
          <div class="pace"></div>
        </div>
      </div>
    </div>
    <div class="progress">
      <div class="slider">
        <div class="loaded"></div>
        <div class="pace"></div>
      </div>
      <div class="timer left">0:00</div>
      <div class="right">
        <div class="repeat icon"></div>
        <div class="shuffle icon"></div>
      </div>
    </div>
  </div>
</div>
<ul id="playlist"></ul>


<div style="text-align:center;margin:10px 0; font:normal 14px/24px 'MicroSoft YaHei';">
</div>

          
        </div>


        </div>
        <div class="m-t">
          
        </div>
        </div>
<div class="col-sm-4">
  <div class="panel-default">
    <div class="panel-heading" style="background-color: #1a2226; border-color: #1a2226; "><p  id="txt_suggestions">Suggestions</p>
    </div>
    <div class="panel-body" style="background-color: #222d32">
         <article class="media">

          <?php   $this-> load-> model('Album_model');
           $DSNgheSi = $this-> Album_model->layDSNgheSiAlbum($album->maAlbum);

                      
           foreach ($DSNgheSi as $key => $value) {
             $nghesi_goiy= $value['maCaSi'];
           }

           $DSAlbum_goiy = $this-> Album_model->layDSGoiYAlbumCuaNgheSi($nghesi_goiy,$album->maAlbum);?>

        <?php foreach ($DSAlbum_goiy as $row): ?>

        <ul class="list-group list-group-lg">
            <li class="list-group-item">
            
          <div class="clear text-ellipsis">
            <a href="<?php echo base_url('site/PlayAlbum/play/'.$row['maAlbum']) ?>" title=""><?php echo $row['tenAlbum'] ?></a>
          </div>
          </li>
        </ul>
        <?php endforeach ?>
    </article>
       
    </div>
      
    </div>
    
  </div>

   </div>
    </section>
    </section>
    </section>
  </section>
</section>
</section>
<!-- /.content -->

      <script src="<?php echo public_url()?>js/jquery-1.7.2.min.js"></script>
      <script src="<?php echo public_url()?>js/js.js"></script>
      <script src="<?php echo public_url()?>js/bootstrap.min.js"></script>
      <script src="<?php echo public_url()?>js/app.min.js"></script>
      <script src="<?php echo public_url()?>js/jquery-ui-1.8.17.custom.min.js"></script>

      <?php echo '<script>var dsbaihat =  \''. $json .'\'; </script>' ?>  

      <script src="<?php echo public_url()?>js/pages/play-album.js"></script>