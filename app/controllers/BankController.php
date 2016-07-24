<?php

class BankController extends BaseController {

	public function getIndex()
	{
		$user = Auth::user();

		return View::make('bank', ['user' => $user]);
	}

	public function createBankAccount()
	{
		$user = Auth::user();
		$bankname = Input::get('bank_name');
		$type = Input::get('account_type');
		$accountNo = rand(1000000, 9999999);

		$bankdata = ['name' => $bankname,'account_no' => $accountNo, 'account_type' => $type, 'user_id' => $user->id];

		$bank = new Bank($bankdata);
		$success = $bank->save();
		
		if($success) {
			return Response::json(['bank'=> $bank]);
		} else {
			return Response::json(['error'=> 'An error occured while processing the data']);
		}
	}
}