<div class="titleArea">
	<div class="wrapper">
		<div class="pageTitle">
			<h5>Bài hát</h5>
			<span>Quản lý bài hát</span>
		</div>
		
		<div class="horControlB menu_action">
			<ul>
				<li><a href="<?php echo admin_url('BaiHat/add') ?>">
					<img src="<?php echo public_url('admin')?>/images/icons/control/16/add.png">
					<span>Thêm mới</span>
				</a></li>
				
				<li><a href="<?php echo admin_url('BaiHat/index') ?>">
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
        <?php   $this-> load-> model('BaiHat_model');
            $chude = $this-> BaiHat_model->layDSChuDeBaiHat($baiHat->maBaiHat);
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


<!--Sáng tác-->
<script language="javascript">
Array.prototype.contains_sangtac = function(item) {
    var i = this.length;
    while (i--) {
        if (this[i]['manhacsi'] == item) {
            return true;
        }
    }
    return false;
}
Array.prototype.remByVal_sangtac = function(val) {
    for (var i = 0; i < this.length; i++) {
        if (this[i]['manhacsi'] === val) {
            this.splice(i, 1);
            i--;
        }
    }
    return this;
}
	var list_nhacsi = new Array();
        <?php   $this-> load-> model('BaiHat_model');
            $nhacsi = $this-> BaiHat_model->layDSNhacSiBaiHat($baiHat->maBaiHat);
        ?>

        <?php foreach ($nhacsi as $key => $value): ?> 
            <?php    
                echo "list_nhacsi.push({manhacsi : '".$value['maNgheSi']."',tennhacsi : '".$value['tenNgheSi']."'});";               
            ?>           
        <?php endforeach ?>

    function add_sangtac(){  

    	if(!list_nhacsi.contains_sangtac($('#sangTac').val()) && $('#sangTac').val()!=""){
    		list_nhacsi.push({
    			manhacsi : $('#sangTac').val(),
    			tennhacsi : $('#sangTac option:selected').text()
    		});
    		$("#list_nhacsi").append('<span class="list_option" id="item_'+ $('#sangTac').val() +'">' + $('#sangTac option:selected').text() + '<a href="javascript:void(0)" onclick="delete_sangtac(\''+$('#sangTac').val()+'\')"> <img style ="margin: 6px 0 0 6px" width="10px" height="10px" src="<?php echo public_url('admin/images')?>/icons/color/delete.png"> </a></span>');
    	}
	}	
	function delete_sangtac(id){
		list_nhacsi.remByVal_sangtac(id);

		$('#item_'+id).fadeOut(200,function(){
			this.remove();
		});

	}   
 </script>

 <!--Trình bày-->
<script language="javascript">
Array.prototype.contains_trinhbay = function(item) {
    var i = this.length;
    while (i--) {
        if (this[i]['macasi'] == item) {
            return true;
        }
    }
    return false;
}
Array.prototype.remByVal_trinhbay = function(val) {
    for (var i = 0; i < this.length; i++) {
        if (this[i]['macasi'] === val) {
            this.splice(i, 1);
            i--;
        }
    }
    return this;
}
	var list_casi = new Array();
        <?php   $this-> load-> model('BaiHat_model');
            $casi = $this-> BaiHat_model->layDSCaSiBaiHat($baiHat->maBaiHat);
        ?>

        <?php foreach ($casi as $key => $value): ?> 
            <?php    
                echo "list_casi.push({macasi : '".$value['maNgheSi']."',tencasi : '".$value['tenNgheSi']."'});";               
            ?>           
        <?php endforeach ?>

    function add_trinhbay(){  
    	if(!list_casi.contains_trinhbay($('#trinhBay').val()) && $('#trinhBay').val()!=""){
    		list_casi.push({
    			macasi : $('#trinhBay').val(),
    			tencasi : $('#trinhBay option:selected').text()
    		});
    		$("#list_casi").append('<span class="list_option" id="item_'+ $('#trinhBay').val() +'">' + $('#trinhBay option:selected').text() + '<a href="javascript:void(0)" onclick="delete_trinhbay(\''+$('#trinhBay').val()+'\')"> <img style ="margin: 6px 0 0 6px" width="10px" height="10px" src="<?php echo public_url('admin/images')?>/icons/color/delete.png"> </a></span>');
    	}
	}	
	function delete_trinhbay(id){
		list_casi.remByVal_trinhbay(id);

		$('#item_'+id).fadeOut(200,function(){
			this.remove();
		});
	}  


 </script>


 <!--Ajax đưa biến lên controller-->
<script language="javascript">
	function load_ajax(){
		$.post('/webmusic/admin/BaiHat/them_chitiet', {
			"list_chude": list_chude,
			"list_casi": list_casi,
			"list_nhacsi": list_nhacsi,
            "mabaihat" : $('#mabaihat').val()				
		}, function(data, textStatus, xhr) {
            if(data)
            {
                    window.location.href = '<?php echo admin_url('BaiHat') ?>'
        }
		});
	}
</script>
 <!--Ajax đưa biến lên controller-->
<script language="javascript">
    function chitiet_edit(){
        $.post('/webmusic/admin/BaiHat/sua_chitiet', {
            "list_chude": list_chude,
            "list_casi": list_casi,
            "list_nhacsi": list_nhacsi,
            "mabaihat" : $('#mabaihat').val()               
        }, function(data, textStatus, xhr) {
            if(data)
            {
                    window.location.href = '<?php echo admin_url('BaiHat') ?>'
        }
        });
    }
</script>