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
    </div>
  </div>
@endsection
