<?php

class AuthTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */

	public function testMethod()
	{
	    $this->call('GET', '/');

	    $this->assertResponseOk();
	}

	public function testSignUpRoute()
	{
	    $this->call('GET', '/login');

	    $this->assertResponseOk();
	}

	public function testLogInRoute()
	{
	    $this->call('GET', '/signup');

	    $this->assertResponseOk();
	}
}