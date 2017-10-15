<!DOCTYPE HTML>
<html>
  @include('common.header')
  <body>
    @include('common.nav')

    <div>
      @yield('content')
    </div>

    @include('common.signin')
    @include('common.signup')

    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="/js/common.js"></script>
    <script src="/js/baidu_spider.js"></script>
    <script src="/js/baidu_statistics.js"></script>
    @yield('js')
  </body>
</html>
