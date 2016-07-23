<?php

class Transaction extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'transactions';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	protected $fillable = ['name', 'user_id', 'sender', 'receiver_id', 'receiver_name', 'bank_name', 'acc_no', 'transaction_type', 'amount'];

	public function user()
	{
		return $this->belongsTo('User');
	}
}