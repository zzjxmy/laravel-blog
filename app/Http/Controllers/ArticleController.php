<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArticleController extends Controller
{
	public function __construct(){
		$this->middleware('auth',['except'=>['index','showArticle']]);
	}
    public function index(){
		$list = Article::orderBy('id','desc')->paginate(2);
		return view('article.list',compact(['list']));
	}

	public function save(Request $request){
		$this->validate($request,
			[
				'title'=>'min:6|required',
				'content'=>'min:6|required',
				'abstract'=>'min:6|required'
			],
			[
				'title.min'=>'标题最少6个字符',
				'title.required'=>'标题必填',
			]
		);
		$article = new Article();
		$article->title = $request->get('title');
		$article->abstract = $request->get('abstract');
		$article->content = $request->get('content');
		$article->user_id = \Auth::id();
		if($article->save()){
			return redirect('/article-list-show')->with(['create_article_success'=>'创建成功']);
		}
		back()->withInput();
	}

	public function showSave(){
		return view('article.add');
	}

	public function delete(Request $request){
		$res = Article::whereIn('id',$request->ids)->delete();
		return $res;
	}

	public function showUpdate($id){
		$article = Article::findOrFail($id);
		return view('article.update',compact(['article']));
	}

	public function update(Request $request,$id){
		$this->validate($request,[
			'title'=>'min:6|required',
			'content'=>'min:6|required',
			'abstract'=>'min:6|required'
		]);
		$res = Article::where('id',$id)->update($request->only(['title','abstract','content']));
		if($res){
			return redirect('/article-list-show')->with(['create_article_success'=>'修改成功']);
		}
		back()->withInput();
	}

	public function showArticle($id){
		$article = Article::findOrFail($id);
		return view('article.article',compact(['article']));
	}
}
