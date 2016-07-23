<?php

class Bank extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'banks';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	protected $fillable = ['name', 'balance', 'account_no', 'account_type', 'user_id'];

	public function user()
	{
		return $this->belongsTo('User');
	}
}