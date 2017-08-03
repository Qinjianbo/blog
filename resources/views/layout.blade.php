<!DOCTYPE HTML>
<html>
  @include('common.header')
  <body>
    @include('common.nav')

    <div>
      @yield('content')
    </div>

    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    @yield('js')
  </body>
</html>
