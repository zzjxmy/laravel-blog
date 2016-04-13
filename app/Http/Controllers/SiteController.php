<?php
namespace App\Http\Controllers;
use App\article;
use App\User;

class SiteController extends Controller{
	public function index(){
		//$article = new article();
		return view('site');
	}

	public function save(){
		return 'view';
	}

	public function test(){
		//return redirect()->to('/save');
		//return redirect()->action('SiteController@index');
		//return redirect()->route('save');
		//echo action('SiteController@index');
		//return public_path().DIRECTORY_SEPARATOR.'uploads';
		//return base_path();
		//return app_path();
		//return resource_path();
		$list = User::get();  //select * from table;
		//var_dump($list);
		dd($list);
	}

}