   <!-- Content Header (Page header) -->
    <!-- Main content -->
  <script language="javascript">
    function Tangluotthich(){
            $.post(
            '/webmusic/site/PlaySong/CapNhatLuotThich/', // URL 
            {
              maBaiHat : "<?php echo $baihat->maBaiHat ?>",
              taiKhoan : "<?php echo $user_info->taiKhoan ?>"
              },  // Data
            function(result){ // Success

            }, 
            'text' // dataTyppe
            );
    }
</script>  
<section class="stretch" style="min-height: 576px">
<section class="content" style="background-color: #3b464d; min-height: 576px;">
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
      <!-- <form action="" method="post" accept-charset="utf-8"> -->
        <div style="margin-top: 8px;margin-right: 54px">
               <a  href="<?php echo base_url('site/PlaySong/CapNhatLuotTai/').$baihat->maBaiHat?>" download="<?php echo $baihat->url ?>"><span class=" icon-right glyphicon glyphicon-download-alt" style="color:#b8c7ce;margin-left: 10px;"></span> </a>
          <?php if(isset($user_info)): ?>
            <?php $this -> load-> model('BaiHatYeuThich_model');?>
            <?php $kiemtra = $this -> BaiHatYeuThich_model -> get_info_mutikey($user_info->taiKhoan,$baihat->maBaiHat); 
            ?>
            <?php if(empty($kiemtra)): ?>
                <a onclick="Tangluotthich()"  id="like">
                 <span  id="like_icon" data-color="#b8c7ce" class="icon-right glyphicon glyphicon-thumbs-up" style="color:#b8c7ce;"></span>
                </a>
              <?php else: ?>
                 <a onclick="Tangluotthich()"  id="like">
                 <span  id="like_icon" data-color="#003bff" class="icon-right glyphicon glyphicon-thumbs-up" style="color:#003bff;"></span>
                </a>
              <?php endif ?>
            <?php endif ?>
        </div>
      <!-- </form> -->

    </div>

  </div>

</div>

<div class="control">
</div>

<div id="lyric">
  <pre>
Bài hát: <?php echo $baihat->tenBaiHat; ?> <br>
Lời bài hát:
<?php echo $baihat->loiBaiHat; ?>
  </pre>
</div>


<div style="text-align:center;margin:10px 0; font:normal 14px/24px 'MicroSoft YaHei';">
</div>

          
        </div>


        </div>
        <div class="m-t">
          
        </div>
        </div>
<div class="col-sm-4">
  <div class="panel-default">
    <div class="panel-heading" style="background-color: #1a2226; border-color: #1a2226; "> <p  id="txt_suggestions">Suggestions</p>
    </div>
    <div class="panel-body" style="background-color: #222d32">
         <article class="media">
          <?php   $this-> load-> model('BaiHat_model');
           $DSNgheSi = $this-> BaiHat_model->layDSNgheSi($baihat->maBaiHat);
           foreach ($DSNgheSi as $key => $value) {
             $nghesi_goiy= $value['maCaSi'];
           }
           $DSBaiHat_goiy = $this-> BaiHat_model->layDSGoiYBaiHatCuaNgheSi($nghesi_goiy,$baihat->maBaiHat);?>
        <?php foreach ($DSBaiHat_goiy as $row): ?>
        <ul class="list-group list-group-lg">
            <li class="list-group-item">
            <div class="pull-right m-l">
            <a href="#" class="m-r-sm">
              <i class="icon-cloud-download"></i>
            </a>

            <a href="#" class="m-r-sm">
              <i class="icon-plus"></i>
            </a>

            <a href="#" class="m-r-sm">
              <i class="icon-close"></i>
            </a>
              
            </div>
          <div class="clear text-ellipsis">
            <a href="<?php echo base_url('site/playsong/play/'.$row['maBaiHat']) ?>" title=""><?php echo $row['tenBaiHat'] ?></a>
           
           <a href="<?php echo base_url('site/PlaySong/CapNhatLuotTai/').$row['maBaiHat']?>" download="<?php echo $row['url']?>"> <span class=" icon-right glyphicon glyphicon-download-alt"></span>  
           </a>          
            <a href="<?php echo base_url('site/playsong/play/'.$row['maBaiHat']) ?>"><span class=" icon-right glyphicon glyphicon-play"></span></a>
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
<?php foreach ($nghesi as $key => $value): ?>
  <?php $casi = $value->ngheSi; ?>
<?php endforeach ?>
<?php 
  $imageURL= base_url('upload/img/').$baihat->imageURL;
 ?>

 <?php 
  $url= base_url('upload/music/').$baihat->url;
 ?>
      <script src="<?php echo public_url()?>js/jquery-1.7.2.min.js"></script>
      <script src="<?php echo public_url()?>js/js.js"></script>
      <script src="<?php echo public_url()?>js/bootstrap.min.js"></script>
      <script src="<?php echo public_url()?>js/app.min.js"></script>
      <script src="<?php echo public_url()?>js/jquery-ui-1.8.17.custom.min.js"></script>

      <?php echo '<script>var tenbaihat =  "'. $baihat->tenBaiHat .'"; </script>' ?>
      <?php echo '<script>var casi =  "'. $casi .'"; </script>' ?>
      <?php echo '<script>var imageURL =  "'. $imageURL .'"; </script>' ?>
      <?php echo '<script>var url =  "'. $url .'"; </script>' ?>

      <script src="<?php echo public_url()?>js/pages/play-song.js"></script>
 <!--Ajax đưa biến lên controller-->




