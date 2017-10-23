@extends('layout')

@section('title', '博文编辑')

@section('active_blog', 'active')

@section('content')
<div class="container mt100">
  <div class="row">
    <div>
      <div class="col-sm-6">
        <form role="form">
          <div class="checkbox">
            <label>
              <input type="checkbox" id="type"/>原创请勾我
            </label>
          </div>
<!--
          <div class="checkbox">
            <label>
              <input type="checkbox" id="type"/>markdown请勾我
            </label>
          </div>
-->
          <div class="form-group">
            <input id="title" type="text" placeholder="请输入博文标题"/>
          </div>
          <div class="form-group">
            <input id="description" type="text" placeholder="请输入博文的简介"/>
          </div>
          <div class="form-group">
             <textarea id="content" class="form-control" rows="30"></textarea>
          </div>
          <button id="submit_btn" class="btn btn-info" type="button">提交</button>
        </form>
      </div>
      <div class="col-sm-6">
        <div class="container" id="parsing_content">
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
  <script src="/js/edit_blog.js"></script>
@endsection
