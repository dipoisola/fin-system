<?php

class TransactionsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Transactions Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|
	*/

	public function getTransactionsPage()
	{
		$userId = Auth::user()->id;

		// $transactions = Transaction::whereRaw('user_id=? or receiver_id=?', [$userId, $userId])->orderBy('id', 'DESC')->get();
		$transactions = Transaction::where('user_id', $userId)->orWhere('receiver_id', $userId)->orderBy('id', 'DESC')->get();

		return View::make('transaction', ['transactions' => $transactions]);
	}

	public function creditOwnWallet()
	{
		$transactionType = 1;

		$user = Auth::user();
		$oldBalance = Auth::user()->wallet_balance;
		$credit = intval(Input::get("credit_amount"));

		$newBalance = $credit + $oldBalance;

		$transaction = [
			'user_id' => $user->id,
			'amount' => $credit,
			'transaction_type' => $transactionType,
			'receiver_id' => $user->id
			];

		$this->makeTransaction($transaction);
		
		$user->wallet_balance = $newBalance;
		$user->save();	

		return Response::json(['balance'=> $user->wallet_balance]);
	}

	/**
	 *	Recepient of credit transfer
	 */
	public function payUser()
	{
		$transactionType = 2;

		$email = Input::get('email');
		$credit = Input::get('credit_amount');

		$user = Auth::user();
		
		$friend = User::where('email', '=', $email)->first();

		if($friend == $user || !$friend) {
			return Response::json(['error' => 'Invalid recepient email']);
		}

		$newBalance = $friend->wallet_balance + $credit;

		$user->wallet_balance -= $credit;

		if($user->wallet_balance < 0) {
			return Response::json(['error'=> 'Insufficient balance']);
		}

		$transaction = [
			'user_id' => $user->id,
			'sender' => $user->username,
			'amount' => $credit,
			'transaction_type' => $transactionType,
			'receiver_id' => $friend->id,
			'receiver_name' => $friend->username
			];

		$this->makeTransaction($transaction);

		$friend->wallet_balance = $newBalance;
		$friend->save();
		

		$user->save();
		
		return Response::json(['balance'=> $user->wallet_balance]);


		// return Redirect::to('dashboard');
	}

	public function creditBankAccount()
	{
		$transactionType = 3;

		$user = Auth::user();
		$credit = intval(Input::get('credit_amount'));
		$bank = Bank::find(intval(Input::get('bankid')));

		$bank->balance += $credit;

		$user->wallet_balance -= $credit;

		if($user->wallet_balance < 0) {
			return Response::json(['error'=> 'Insufficient balance']);
		}

		$transaction = [
			'user_id' => $user->id,
			'bank_name' => $bank->name,
			'acc_no' => $bank->account_no,
			'amount' => $credit,
			'transaction_type' => $transactionType,
			'receiver_id' => $user->id
			];

		$this->makeTransaction($transaction);
		
		$bank->save(); 
		$user->save();

		return Response::json(['balance'=> $user->wallet_balance]);
	}

	public function makeTransaction($transactionData)
	{
		$newTransaction = new Transaction($transactionData);	
		$newTransaction->save();
	}
}