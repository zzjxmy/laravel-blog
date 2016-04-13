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
        <h2 class="sub-header">编辑文章</h2>
        <form class="form-horizontal" action="{{url('/article-update/'.$article->id)}}" method="post">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">标题</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="title" value="{{$article->title}}" placeholder="title" name="title">
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">摘要</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="abstract" placeholder="abstract" value="{{$article->abstract}}" name="abstract">
                    @if ($errors->has('abstract'))
                        <span class="help-block">
                            <strong>{{ $errors->first('abstract') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">内容</label>
                <div class="col-sm-6">
                    <textarea class="form-control" rows="10" cols="30"  name="content">{{$article->content}}</textarea>
                    @if ($errors->has('content'))
                        <span class="help-block">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">修改</button>
                </div>
            </div>
        </form>
    </div>
@endsection