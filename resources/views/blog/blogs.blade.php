@extends('layout')

@section('title', '博文列表')
@section('keywords', 'Blogs 博客列表 博文列表')
@section('description', '这里是波波写的博文的列表页面! This is the page of bobo`s blogs!')

@section('active_blog', 'active')

@section('content')
  <div class="container blog-body">
    @foreach($list as $blog)
    <div class="row">
      <h4><a href="/blog/{{ $blog['id'] }}">{{ $blog['title'] }}</a></h4>
      <div><div>{{ $blog['nickname'] }}</div><div class="glyphicon glyphicon-eye-open"></div>&nbsp;{{$blog['reading']}}</div>
    </div>
    <hr class="split-line"/>
    @endforeach
    {{$pagination->links()}}
  </div>
@endsection
