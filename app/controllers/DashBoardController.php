<?php

class DashboardController extends BaseController {

	public function get()
	{
		$user = Auth::user();

		return View::make('dashboard', ['user' => $user]);
	}
}