@extends('layout')

@section('title', '博文编辑')

@section('active_blog', 'active')

@section('content')
<div class="container mt100">
  <div class="row">
    <div>
      <div class="col-sm-6">
        <form role="form">
          <input id="blog_id" value="{{$blog['id'] ?? 0}}" type="hidden">
          <div class="checkbox">
            <label>
              <input type="checkbox" id="type" @if($blog['type'] ?? '') checked @endif/>原创请勾我
            </label>
          </div>
          <div class="form-group">
            <input id="title" type="text" placeholder="请输入博文标题" value="{{$blog['title'] ?? ''}}" style="min-width: 100%;"/>
          </div>
          <div class="form-group">
            <input id="description" type="text" placeholder="请输入博文的简介" value="{{$blog['description'] ?? ''}}" style="min-width: 100%;"/>
          </div>
          <div class="form-group">
             <textarea id="content" class="form-control" rows="30">{{$blog['content'] ?? ''}}</textarea>
          </div>
          <button id="submit_btn" class="btn btn-info" type="button">提交</button>
        </form>
      </div>
      <div class="col-sm-6">
        <div id="parsing_content">
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
  <script src="/js/edit_blog.js"></script>
@endsection
