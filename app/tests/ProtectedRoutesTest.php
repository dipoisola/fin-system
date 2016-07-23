<?php

class ProtectedRoutesTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */


	public function testDashboard()
	{
		Route::enableFilters();

		$crawler = $this->client->request('GET', '/dashboard');

		$this->assertFalse($this->client->getResponse()->isOk());
	}

	public function testTransactions()
	{
		Route::enableFilters();
		
		$crawler = $this->client->request('GET', '/transactions');

		$this->assertFalse($this->client->getResponse()->isOk());
	}

	public function testMyBanks()
	{
		Route::enableFilters();
		
		$crawler = $this->client->request('GET', '/mybanks');

		$this->assertFalse($this->client->getResponse()->isOk());
	}

}	