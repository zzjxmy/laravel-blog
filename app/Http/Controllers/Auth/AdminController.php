<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
	public function login ( Request $request )
	{
		if ( $request->method() == 'POST' ) {
			$nameAndPass = $request->only(['name' , 'password']);
			$bool = \Auth::guard('admin')->attempt($nameAndPass);
			var_dump($bool);
		}

		return view('auth.login-admin');
	}
}
