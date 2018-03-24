@extends('layout')

@section('title', '波波的博文列表')
@section('keywords', 'Blogs 博客列表 博文列表')
@section('description', '这里是波波写的博文的列表页面! This is the page of bobo`s blogs!')
@section('css')
  <link rel="stylesheet" href="/css/blog.css">
@endsection

@section('active_blog', 'active')

@section('content')
  <div class="container blog-body">
    @foreach($list as $blog)
    <div class="row">
      <div class="col-xs-12">
        <h4><a href="/blog/{{ $blog['id'] }}">{{ $blog['title'] }}</a></h4>
        <div><div class="author">{{ $blog['nickname'] }}</div><div class="author">{{ $blog['created_at'] }}</div><div class="glyphicon glyphicon-eye-open"></div>&nbsp;{{$blog['reading']}}</div>
      </div>
    </div>
    <hr class="split-line"/>
    @endforeach
    {{$pagination->links()}}
  </div>
@endsection
@section('js')
<script src="https://cdn.bootcss.com/three.js/90/three.min.js"></script>
<script src="/js/list_3dbg.js"></script>
@endsection
