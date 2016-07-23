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
		$username = Input::get('username');
		$name = Input::get('name');
		$email = Input::get('email');
		$password = Input::get('password');
		$password_c = Input::get('password_confirmation');

		$userdata = [
			'username' => $username,
			'name' => $name,
			'email' => $email,
			'password' => $password,
			'password_confirmation' => $password_c
			];

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

		if($validator->fails())
		{
			return Redirect::to('signup')->withErrors($validator);		
		}

		$user = new User([
			'username' => $username,
			'name' => $email,
			'email' => $email,
			'password' => Hash::make($password)
			]);
		
		$user->save();	

		return Redirect::to('dashboard');
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
			return Redirect::to('login');
		}
	}

	public function logUserOut()
	{
		Auth::logout();

		return Redirect::to('login');
	}

}