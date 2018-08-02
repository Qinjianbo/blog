@extends('layout')

@section('title')
{{$blog['title']}}-boboidea
@endsection
@section('keywords')
{{$blog['title']}},boboidea
@endsection
@section('description')
{{$blog['description']}},boboidea
@endsection
@section('active_blog', 'active')
@section('css')
  <link rel="stylesheet" href="/css/blog.css">
@endsection

@section('content')
  <div class="container mt100">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3>{{$blog['title']}}</h3>
      </div>
      <div id="body-content" class="panel-body">
        {{$blog['content']}}
      </div>
      <div>&nbsp;&nbsp;&nbsp;&nbsp;Copyright &copy; 2017 - 2018 boboidea.com All Rights Reserved 波波创意软件工作室 版权所有 【转载请注明出处】</div>
    </div>
    <div>
    <!--PC和WAP自适应版-->
    <div id="SOHUCS" sid="{{$blog['id']}}" ></div>
    <script type="text/javascript"> 
        (function(){ 
            var appid = 'cytKjqTkY'; 
            var conf = 'prod_309456d8de1da69fc40333e786f746de'; 
            var width = window.innerWidth || document.documentElement.clientWidth; 
            if (width < 960) { 
                window.document.write('<script id="changyan_mobile_js" charset="utf-8" type="text/javascript" src="https://changyan.sohu.com/upload/mobile/wap-js/changyan_mobile.js?client_id=' + appid + '&conf=' + conf + '"><\/script>');  
            } else { 
                var loadJs=function(d,a){var c=document.getElementsByTagName("head")[0]||document.head||document.documentElement;var b=document.createElement("script");b.setAttribute("type","text/javascript");b.setAttribute("charset","UTF-8");b.setAttribute("src",d);if(typeof a==="function"){if(window.attachEvent){b.onreadystatechange=function(){var e=b.readyState;if(e==="loaded"||e==="complete"){b.onreadystatechange=null;a()}}}else{b.onload=a}}c.appendChild(b)};loadJs("https://changyan.sohu.com/upload/changyan.js",function(){window.changyan.api.config({appid:appid,conf:conf})});  
            } 
        })(); 
    </script>
    </div>
  </div>
@endsection
