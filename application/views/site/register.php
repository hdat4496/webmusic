<form action="<?php echo base_url('User/register') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modaldialogdk">
          <div class="modal-content modaldk" style="height: 480px">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel">ĐĂNG KÝ</h4>
            </div>
            <div class="modal-body modalbodydk">
              <form role="form">

                <div class="form-group">
                   <input type="text" name="hoTen" id="first_name boxdk" class="form-control input-lg" placeholder="Họ và tên" tabindex="1">
                   <div name="hoTen_error" class="clear error"><?php
                   $this-> load->helper('form');
                    echo form_error('hoTen');?> 
                     </div>             
                </div>



                <div class="form-group">
                  <input type="email" name="email" id="email boxdk" class="form-control input-lg" placeholder="Địa Chỉ Email" tabindex="2">
                  <div name="hoTen_error" class="clear error"></div> 
                </div>

             
                <div class="form-group">
                  <input type="text" name="taiKhoan" id="display_name boxdk" class="form-control input-lg" placeholder="Tên đăng nhập" tabindex="3">
                  <div name="hoTen_error" class="clear error"></div>
                </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="password" name="matKhau" id="password boxdk" class="form-control input-lg" placeholder="Mật Khẩu" tabindex="4">
                      <div name="matKhau_error" class="clear error"></div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="password" name="nhapLai_MatKhau" id="password_confirmation boxdk" class="form-control input-lg" placeholder="Nhập Lại Mật Khẩu" tabindex="5">
                      <div name="nhapLai_MatKhau_error" class="clear error"></div>
                    </div>
                  </div>
                </div> 

        <div style="float:left;">
            <div class="form-group">
              <div class="btn-group beds-baths-group" id="beds-baths-group" data-toggle="buttons">
                <div class="first-label" style=" float: left; padding-top: 10px;font-weight: 400;margin-left: 6px;">
                    <span style="color: #a59999;" class="icon icon-baths">Giới tính: </span>
                </div>

                 <label class="btn btn-default beds-baths beds-baths-1 " style="width: 100px;float: left;margin-left: 30px;">
                    <input type="radio" name="gioiTinh" id="option1" value="Nam"  autocomplete="off">
                    <span class="icon icon-blank-space"></span>
                    <span class="beds-baths-word">Nam</span>
                </label>
                  
                <label class="btn btn-default beds-baths beds-baths-2" style="width: 100px;float: left;">
                    <input type="radio" name="gioiTinh" id="option2" selected value="Nữ" autocomplete="off">
                    <span class="icon icon-blank-space"></span>
                    <span class="beds-baths-word">Nữ</span>
                </label>
                <span class="beds-baths-clearfix"></span>

              </div>
            </div> 

              <div class="form-group">
                <div class="first-label" style=" float: left; padding-top: 10px;font-weight: 400;margin-left: 6px;">
                    <span style="color: #a59999;" class="icon icon-baths">Ảnh đại diện: </span>
                </div>

                  <div class="input-group" style="width: 100px;float: left;margin-left: 5px;">
                      <span class="input-group-btn">
                          <span class="btn btn-default btn-file glyphicon glyphicon-folder-open" style="padding-bottom: 10px;padding-top: 8px;margin-top: -2px;
">
                            <input type="file" id="imgInp" name="image">
                          </span>
                      </span>
                      <input type="text" class="form-control" style="width: 162px; "readonly>
                  </div>
              </div>
          </div>

                  <img style="margin-left: 30px;float: left;width: 150px;height: 120px;margin-top: -10px;display: none;" id='img-upload'/>
              </form>
            </div>
            <div class="modal-footer modalfooterdk">
              <button type="submit" name="submit" class="form-control btndk btn-primary">Đăng Ký</button>
             
              <div class="progress">
                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="100" style="width: 0%;">
                  <span class="sr-only">progress</span>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </form>
      

<?php if(!isset($user_info)): ?>
      <script src="<?php echo public_url()?>js/jquery-1.7.2.min.js"></script>
      <script src="<?php echo public_url()?>js/js.js"></script>
      <script src="<?php echo public_url()?>js/bootstrap.min.js"></script>
<?php endif; ?>
<!-- preview hình -->
<script type="text/javascript">
$(document).ready( function() {
      $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
      
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
                $('#img-upload').css('display','block'); 
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });   
  });
</script>
