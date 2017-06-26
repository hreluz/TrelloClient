<?php

use App\TrelloAccount;

class AddTrelloAccountTest extends FeatureTestCase
{
	public function test_a_user_can_add_a_trello_account()
	{
		$user = $this->defaultUser();
	   	$this->actingAs($user);

		$token = env('TRELLO_ACCOUNT_KEY');
		$name = 'Account 1';

		//When
		$this->visitRoute('trello_accounts.add')
			->type($name, 'name')
			->type($token, 'trello_token')
			->press('Add');

		//Then
		$this->seeInDatabase('trello_accounts', [
			'trello_token' => $token,
			'name' => $name,
			'user_id' => $user->id
		]);	   

	    $trello_account = TrelloAccount::first();

		$this->seePageIs($trello_account->dashboard_url)
			->seeText($name);
	}

	public function test_add_a_trello_account_requires_authentication()
	{
		///When
		$this->visitRoute('trello_accounts.add')
			->seePageIs(route('login'));
	}

	public function test_add_a_trello_account_form_validation()
	{
		$this->actingAs($this->defaultUser());

		//When
		$this->visitRoute('trello_accounts.add')
			->press('Add')
			->seeErrors([
				'trello_token' => 'The trello token field is required.',
				'name' => 'The name field is required.',
			]);
	}
}
	