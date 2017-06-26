<?php
use App\Board;

class CreateAListTest extends FeatureTestCase
{
	public function test_create_a_list()
	{
		$account = $this->defaultTrelloAccount();
		$user = $account->user;

		$this->actingAs($user);

		//Create a Board
		$name = 'List '.str_random(10);
		$board = Board::createApi(['name' => $name] , $account);

		//When
		$this->visit(route('lists.index',[$account, $board]))
			->click('Create List')
			->type($name, 'name')
			->press('Create');

		$this->seePageIs(route('lists.index', [$account, $board]))
			->seeText($name);
	}

	public function test_create_a_list_form_validation()
	{
		$account = $this->defaultTrelloAccount();
		$user = $account->user;
		$board = Board::createApi(['name' => 'AnyName'] , $account);

		$this->actingAs($user);

		//When
		$this->visit(route('lists.create',[$account, $board]))
			->press('Create')
			->seeErrors([
				'name' => 'The name field is required.',
			]);
	}
}
