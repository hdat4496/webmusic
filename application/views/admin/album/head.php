
<div class="titleArea">
	<div class="wrapper">
		<div class="pageTitle">
			<h5>Album</h5>
			<span>Quản lý album</span>
		</div>
		
		<div class="horControlB menu_action">
			<ul>
				<li><a href="<?php echo admin_url('album/load_add') ?>">
					<img src="<?php echo public_url('admin')?>/images/icons/control/16/add.png">
					<span>Thêm mới</span>
				</a></li>
				
				<li><a href="<?php echo admin_url('album/index') ?>">
					<img src="<?php echo public_url('admin') ?>/images/icons/control/16/list.png">
					<span>Danh sách</span>
				</a></li>
			</ul>
		</div>
		
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript">
(function($)
{
	$(document).ready(function()
	{
		var main = $('#form');
		
		// Tabs
		main.contentTabs();
	});
})(jQuery);
</script>


<!--Chủ đề-->
<script language="javascript">
Array.prototype.contains_chude = function(item) {
    var i = this.length;
    while (i--) {
        if (this[i]['machude'] == item) {
            return true;
        }
    }
    return false;
}
Array.prototype.remByVal_chude = function(val) {
    for (var i = 0; i < this.length; i++) {
        if (this[i]['machude'] === val) {
            this.splice(i, 1);
            i--;
        }
    }
    return this;
}
	    var list_chude = new Array();
        <?php  
        if(isset($album)) $maAlbum=$album->maAlbum;
        else $maAlbum=''; 
        $this-> load-> model('Album_ChuDe_model');
            $chude = $this-> Album_ChuDe_model->layDSChuDeAlbum($maAlbum);
        ?>

        <?php foreach ($chude as $key => $value): ?> 
            <?php    
                echo "list_chude.push({machude : '".$value['maChuDe']."',tenchude : '".$value['tenChuDe']."'});";               
            ?>           
        <?php endforeach ?>
                            


    function add_chude(){  
        if(!list_chude.contains_chude($('#chuDe').val()) && $('#chuDe').val()!=""){
            list_chude.push({
                machude : $('#chuDe').val(),
                tenchude : $('#chuDe option:selected').text()
            });
            $("#list_chude").append('<span class="list_option" id="item_'+ $('#chuDe').val() +'">' + $('#chuDe option:selected').text() + '<a href="javascript:void(0)" onclick="delete_chude(\''+$('#chuDe').val()+'\')"> <img style ="margin: 6px 0 0 6px" width="10px" height="10px" src="<?php echo public_url('admin/images')?>/icons/color/delete.png"> </a></span>');
        }
    }   
    function delete_chude(id){
        list_chude.remByVal_chude(id);

        $('#item_'+id).fadeOut(200,function(){
            this.remove();
        });
    } 
 </script>

<!--Ajax đưa biến lên controller-->
<script language="javascript">
    function load_ajax(){
        $.post('/webmusic/admin/Album/add', {
            "list_chude": list_chude,
            "tenAlbum" : $('#tenAlbum').val(),
            "maQuocGia" : $('#quocGia').val()
            //"imageURL" : $('#image').val()             
        }, function(data, textStatus, xhr) {
            if(data)
            {	
            	console.log(data);
            		var str= '/webmusic/admin/Album/add_image/'+data;
                    window.location.href = str;
        }
        else
        {
        	alert('Mời bạn nhập đầy đủ thông tin');
        }
        });
    }
</script>

<!--Ajax đưa biến lên controller-->
<script language="javascript">
    function load_ajax_edit(){
    	console.log(list_chude[0]);
        console.log($('#tenAlbum').val());
        console.log($('#quocGia').val());
        console.log($('#maAlbum').text());
        $.post('/webmusic/admin/Album/edit', {
            "list_chude": list_chude,
            "tenAlbum" : $('#tenAlbum').val(),
            "maQuocGia" : $('#quocGia').val(),
            "maAlbum" : $('#maAlbum').text()     
        }, function(data, textStatus, xhr) {
            if(data)
            {	
            	console.log(data);
                    //var str='/webmusic/admin/Album/view/'+data;
            		var str= '/webmusic/admin/Album/edit_image/'+data;
                    window.location.href = str;
        }
        else
        {
        	alert('Mời bạn nhập đầy đủ thông tin');
        }
        });
    }
</script>

