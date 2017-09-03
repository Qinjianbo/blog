@extends('layout')

@section('title', 'Blog')

@section('active_blog', 'active')

@section('content')
  <input id="page" type="hidden" value="1">
  <input id="totalPage" type="hidden" value="1">
  <div class="container blog-body">
  </div>
@endsection
@section('js')
<script src="/js/blog.js"></script>
@endsection
