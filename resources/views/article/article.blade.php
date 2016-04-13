@extends('layouts.base')
@section('nav')
    <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
            <li class="active"><a href="{{url('/article-list-show')}}">文章管理</a></li>
            <li ><a href="{{url('/article-save-show')}}">发表文章</a></li>
        </ul>
    </div>
@endsection
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="blog-header">
        <h1 class="blog-title">The Bootstrap Blog</h1>
        <p class="lead blog-description">{{$article->abstract}}</p>
    </div>
    <div class="row">
        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <h2 class="blog-post-title">{{$article->title}}</h2>
                <p class="blog-post-meta">{{$article->created_at->format('Y-m-d H:i')}} by <a href="#">{{$article->user->name}}</a></p>
                <div>
                    {{$article->content}}
                </div>
            </div>
        </div>
        <!-- /.blog-main -->
    </div>

</div>
@endsection