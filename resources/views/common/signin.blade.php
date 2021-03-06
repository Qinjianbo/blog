<div class="modal fade" id="signin_modal" tabindex="-1" role="dialog" aria-labelledby="signin_title">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title" id="signin_title">欢迎登陆</h4>
       </div>
       <div class="modal-body">
          <div class="row">
            <label class="col-xs-2 col-xs-offset-2" for="username_signin">用户名:</label>
            <div class="col-xs-8">
              <input type="text" class="form-control" id="username_signin" placeholder="请输入用户名">
            </div>
          </div>
          <div class="row">
            <label class="col-xs-2 col-xs-offset-2" for="password_signin">密码:</label>
            <div class="col-xs-8">
              <input type="password" class="form-control" id="password_signin" placeholder="请输入密码">
            </div>
          </div>
          <div class="row">
            <label class="col-xs-2 col-xs-offset-2" for="captcha_signin">验证码:</label>
            <div class="col-xs-4">
              <input type="text" class="form-control" id="captcha_signin" placeholder="请输入图中验证码">
            </div>
            <div class="col-xs-4">
              <img id="img_signin" onclick="refreshImg(this)">
            </div>
          </div>
        </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">取消登陆</button>
         <button type="button" class="btn btn-primary" id="signin_btn">确认登陆</div>
       </div>
    </div>
  </div>
</div>

