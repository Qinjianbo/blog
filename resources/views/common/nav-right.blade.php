<div class="navbar-right">
  <form method="GET" action="" class="navbar-form navbar-left hidden-sm hidden-md">
    <div class="form-group">
      <input class="form-control search-input" placeholder="搜索" name="q" type="text" value>
    </div>
  </form>

  <ul class="nav navbar-nav hidden" id="before_signin">
    <a class="btn btn-primary login-btn" data-toggle="modal" data-target="#signin_modal">
      <i class="fa fa-user"></i>
      登录
    </a>
    <a class="btn btn-primary login-btn" data-toggle="modal" data-target="#register_modal">
      <i class="fa fa-user"></i>
      注册
    </a>
  </ul>

  <ul class="nav navbar-nav" id="after_signin">
    <li>
      <a href="#" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dLabel">
        <!--
        <img class="avatar-topnav" src="https://dn-phphub.qbox.me/uploads/avatars/15609_1492940220.png?imageView2/1/w/100/h/100"/>
        -->
        <label id="nickname">游客</label>
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" aria-labelledby="dLabel">
        <li>
          <a class="button" href="/blog/add" target="_blank">
              发表博文
          </a>
        </li>
        <li>
          <a class="button" href="">
              编辑资料
          </a>
        </li>
        <li>
          <a class="button" id="signout_btn" href="">
              退出
          </a>
        </li>
      </ul>
    </li>
  </ul>
</div>

