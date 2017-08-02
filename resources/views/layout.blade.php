<!DOCTYPE HTML>
<html>
  @include('common.header')
  <body>
    @include('common.nav')

    <div>
      @yield('content')
    </div>

    @yield('js')
  </body>
</html>
