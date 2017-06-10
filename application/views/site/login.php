<?php if(!isset($user_info)): ?>
<form action="<?php echo base_url('User/login') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
      <div class="modal fade" id="myModal"  aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modaldialogdn">
          <div class="modal-content modaldn" style="height: 300px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel">ĐĂNG NHẬP</h4>
            </div>
            <div class="modal-body modalbodydn">
              <form role="form">

                <div class="form-group">
                  <div class="input-group">
                    <input type="text" name="tenTaiKhoanDangNhap" class="form-control" id="uLogin" placeholder="Nhập Tài Khoản">
                    <label for="uLogin" class="input-group-addon glyphicon-user"></label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <input type="password" name="matKhauDangNhap" class="form-control" id="uPassword" placeholder="Nhập Mật Khẩu">
                    <label for="uPassword" class="input-group-addon glyphicon-lock"></label>
                  </div>
                </div>
                <div class="row bodere">
                 <div class="checkbox  col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding-left: 40px;">
    
                </div>

              </div>
            </form>
          </div>
          <div class="modal-footer modalfooterdn">
            <button name ="login" type="submit" name="submit_dn" class="form-control btndn btn-primary">Đăng Nhập</button>
            
          </div> 
        </div>
      </div>
    </div>
    </form>
  <?php endif ?>