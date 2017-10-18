@extends('layout')

@section('title')
  {{$blog['title']}}
@endsection
@section('keywords')
  {{$blog['title']}}
@endsection
@section('description')
  {{$blog['description']}}
@endsection
@section('active_blog', 'active')

@section('content')
  <div class="container mt100">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3>{{$blog['title']}}</h3>
      </div>
      <div id="body-content" class="panel-body">
      </div>
      <div>&nbsp;&nbsp;&nbsp;&nbsp;Copyright &copy; 2017 - 2017 boboidea.com All Rights Reserved 波波创意软件工作室 版权所有 【未经允许，谢绝转载】</div>
      <div class="panel-footer">
          READ:{{$blog['reading']}}
      </div>
    </div>
  </div>
<div id="content_hidden" style="display:none">{{$blog['content']}}</div>
@endsection

@section('js')
  <script src="/js/blog_detail.js"></script>
@endsection
