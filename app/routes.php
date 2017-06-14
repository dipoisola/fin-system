<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showWelcome');

Route::get('/signup', 'AuthController@index');

Route::post('/signup', ['uses' => 'AuthController@registerUser']);

Route::get('/login', 'AuthController@getLoginPage');

Route::post('/login', ['uses' => 'AuthController@logUserIn']);

Route::get('/auth/logout', 'AuthController@logUserOut');

Route::post('/pay/me', ['uses' => 'TransactionsController@creditOwnWallet']);

Route::get('/mybanks', ['before'   => 'auth', 'uses' => 'BankController@getIndex']);

Route::post('/pay/user', ['uses' => 'TransactionsController@payUser']);

Route::post('/pay/bank', ['uses' => 'TransactionsController@creditBankAccount']);

Route::post('/mybanks/create', ['uses' => 'BankController@createBankAccount']);

Route::get('/dashboard', ['before'   => 'auth', 'uses' => 'DashboardController@get']);

Route::get('/transactions', ['before'   => 'auth', 'uses' => 'TransactionsController@getTransactionsPage']);
