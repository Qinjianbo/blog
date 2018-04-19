@extends('layout')

@section('title', '波波的博文列表')
@section('keywords', 'Blogs 博客列表 博文列表')
@section('description', '这里是波波写的博文的列表页面! This is the page of bobo`s blogs!')

@section('active_blog', 'active')
@section('css')
  <link rel="stylesheet" href="/css/blog.css">
@endsection

@section('content')
  <input id="page" type="hidden" value="1">
  <input id="totalPage" type="hidden" value="1">
  <div class="container my-blog-body">
  </div>
@endsection
@section('js')
<script src="/js/blog.js"></script>
@endsection
