@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @foreach($list as $post)
                <div class="panel panel-default">
                    <div class="panel-heading">{{$post->title}}</div>

                    <div class="panel-body">
                       <div> {{$post->content}}</div>
                        <div>{{$post->created_at->format('Y-m-d H:i')}}</div>
                        <div>{{$post->user->name}}</div>
                        @if($post->user_id == \Auth::id())
                        <div><a href="{{url('post/update',['id'=>$post->id])}}">编辑</a></div>
                        <div><a href="{{url('post/delete',['id'=>$post->id])}}">删除</a></div>
                        @endif
                    </div>
                </div>
                @endforeach
                <div>
                    {{$list->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
