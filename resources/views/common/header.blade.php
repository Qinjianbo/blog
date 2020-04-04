<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Jianbo Qin">
  <meta name="keywords" content="@yield('keywords')">
  <meta name="description" content="@yield('description')">
  @yield('meta')
  <title>@yield('title')</title>
  <link rel="shortcut icon" href="{{ config('blog.default_icon') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/basic.css">
  <style>
    html {
      -webkit-filter: grayscale(100%);filter:progid:DXImageTransform.Microsoft.BasicImage(graysale=1);
    }
  </style>
  @yield('css')
  <meta name="chinaz-site-verification" content="3FCB82F6E2142A3C">
</head>
