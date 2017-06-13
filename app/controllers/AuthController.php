<?php

class AuthController extends BaseController {

	public function index()
	{
		return View::make('auth.register');
	}

	public function getLoginPage()
	{
		return View::make('auth.login');
	}

	public function registerUser()
	{
		$userdata = Input::except(['join', '_token']);

		$validator = Validator::make(
		    $userdata,
		    [
		    	'username' => 'required',
		    	'name' => 'required',
		    	'email' => 'required|email|unique:users',
		    	'password' => 'required|min:6|confirmed',
		    	'password_confirmation' => 'required|min:6'
		    ]
		);

		if($validator->fails()) {
			return Redirect::to('signup')->withErrors($validator);
		}

		$user = new User([
			'username' => $userdata['username'],
			'name' => $userdata['name'],
			'email' => $userdata['email'],
			'password' => Hash::make($userdata['password'])
			]);

		$user->save();
		Session::flash('info', 'Registration successful, you can now login');
		return Redirect::to('login');
	}

	public function logUserIn()
	{
		$username = Input::get('username');
		$password = Input::get('password');

		if (Auth::attempt(['username' => $username, 'password' => $password]))
		{
			$user = Auth::user();

		    return Redirect::to('dashboard');
		} else {
			Session::flash('info', 'Wrong login details');
			return Redirect::to('login');
		}
	}

	public function logUserOut()
	{
		Auth::logout();

		return Redirect::to('login');
	}

}