<?php

use App\Board;
use App\Listing;

class CreateACardTest extends FeatureTestCase
{

	public function test_create_a_card()
	{
		$account = $this->defaultTrelloAccount();
		$this->actingAs($account->user);

		//Create a Board
		$board = Board::createApi(['name' => str_random()] , $account);

		//Create List
		$list = Listing::createApi(['name' => str_random()] , $account, $board);

		//When
		$name = 'Card'.str_random();
		$this->visit(route('cards.index',[$account, $list]))
			->click('Create Card')
			->type($name, 'name')
			->press('Create');

		$this->seePageIs(route('cards.index', [$account, $list]))
			->seeText($name);
	}

	public function test_create_a_card_form_validation()
	{
		$account = $this->defaultTrelloAccount();

		//Create a Board
		$board = Board::createApi(['name' => str_random()] , $account);

		//Create List
		$list = Listing::createApi(['name' => str_random()] , $account, $board);

		$this->actingAs($account->user);

		//When
		$this->visit(route('cards.create',[$account, $list]))
			->press('Create')
			->seeErrors([
				'name' => 'The name field is required.',
			]);
	}	
}
