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
}