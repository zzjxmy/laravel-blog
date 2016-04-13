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
        <h2 class="sub-header">文章列表</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><input type="checkbox" class="article-checkbox"></th>
                    <th>文章编号</th>
                    <th>标题</th>
                    <th>文章摘要</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $article)
                <tr>
                    <td><input type="checkbox" name="check" value="{{$article->id}}"></td>
                    <td>{{$article->id}}</td>
                    <td>{{$article->title}}</td>
                    <td>{{$article->abstract}}</td>
                    <td>{{$article->updated_at->format('Y-m-d H:i')}}</td>
                    <td>
                        <a href="{{url('/article-show/'.$article->id)}}">查看</a> /
                        <a href="{{url('article-update-show/'.$article->id)}}">修改</a>
                    </td>
                </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div>
            <button id="delete_article" class="btn btn-danger btn-sm btn">删除</button>
        </div>
        <div>
            {{$list->links()}}
        </div>
    </div>
@endsection
@section('script')
<script>
    @if(session()->has('create_article_success'))
        alert('{{session('create_article_success')}}');
    @endif
    $('.article-checkbox').click(function(){
       $("input[name=check]").prop('checked',$(this).prop('checked'));
    });
    $('#delete_article').click(function(){
       if(confirm('您确定要删除吗？')){
           var ids = [];
           $("input[name=check]:checked").each(function(){
               ids.push($(this).val());
           })
           $.post('/article-delete',{ids:ids,_method:'DELETE'},function(data){
               if(data){
                   window.location.reload();
                    //$('input[name=check]:checked').parent().parent().remove();
               }
           });
       }
    });
</script>
@endsection