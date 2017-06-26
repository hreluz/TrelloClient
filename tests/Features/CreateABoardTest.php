<?php

class CreateABoardTest extends FeatureTestCase
{
	public function test_create_a_board()
	{
		$account = $this->defaultTrelloAccount();
		$user = $account->user;

		$this->actingAs($user);

		$name = 'Board Number 1'.str_random(10);

		//When
		$this->visit(route('boards.index', $account))
			->click('Create Board')
			->type($name, 'name')
			->press('Create');

		$this->seePageIs(route('boards.index', [$account]))
			->seeText($name);
	}

	public function test_create_a_board_form_validation()
	{
		$account = $this->defaultTrelloAccount();
		$user = $account->user;

		$this->actingAs($user);

		$this->actingAs($this->defaultUser());

		//When
		$this->visit(route('boards.create', $account))
			->press('Create')
			->seeErrors([
				'name' => 'The name field is required.',
			]);
	}
}
