<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">BoBoidea</a>
    </div>
    <div class="navbar-collapse collapse" id="navbar">
      <ul class="nav navbar-nav">
        <li class="@yield('active_blog')">
          <a href="/">博客天地</a>
        </li>
        <li class="@yield('active_about')">
          <a href="/about">关于波波</a>
        </li>
        <!--
        <li class="@yield('active_home')">
          <a href="/">首页</a>
        </li>
        <li class="@yield('active_freshman')">
          <a href="/freshman">小白专场</a>
        </li>
        -->
      </ul>

      @include('common.nav-right')
    </div>
  </div>
</nav>
