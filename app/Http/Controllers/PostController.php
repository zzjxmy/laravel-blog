<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
	public function index(){
		$list = Post::orderBy('id','desc')->paginate(2);
		return view('post.index',['list'=>$list]);
	}

    public function create(){
		return view('post.create');
	}

	public function save(Request $request){
		$rules = [
			'title'=>'required|max:10',
		];
		$this->validate($request,$rules);
		$post = new Post();
		$post->title = $request->get('title');
		$post->content = $request->get('content');
		$post->user_id = \Auth::id();
		if($post->save()){
			return redirect()->to('post');
		}
		back();
	}
}
