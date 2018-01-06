@extends('layout')

@section('title', '博文列表')
@section('keywords', 'Blogs 博客列表 博文列表')
@section('description', '这里是波波写的博文的列表页面! This is the page of bobo`s blogs!')

@section('active_blog', 'active')

@section('content')
  <div class="container blog-body">
    @foreach($list as $blog)
    <div class="row">
      <h4><a href="/blog/{{ $blog->id }}">{{ $blog->title }}</a></h4>
      <div><div>{{ $blog->nickname }}</div><div class="glyphicon glyphicon-eye-open"></div>&nbsp;{{$blog->reading}}</div>
    </div>
    <hr class="split-line"/>
    @endforeach
    <ul class="pagination pagination-lg">
      <li><a href="#">&laquo;</a></li>
      <li><a href="#">1</a></li>
      <li><a href="#">2</a></li>
      <li><a href="#">3</a></li>
      <li><a href="#">4</a></li>
      <li><a href="#">5</a></li>
      <li><a href="#">&raquo;</a></li>
    </ul>
  </div>
@endsection
