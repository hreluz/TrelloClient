<?php

class EditABoardTest extends FeatureTestCase
{
	public function test_edit_a_board()
	{
		$account = $this->defaultTrelloAccount();
		
		$user = $account->user;

		$this->actingAs($user);

		$name = 'Board 511'.str_random(10);
		$new_name = 'Board Edited '.str_random(10);

		//Create a Board
		$this->visit(route('boards.index', $account))
			->click('Create Board')
			->type($name, 'name')
			->press('Create');

		//When Editing a Board
		$this->seePageIs(route('boards.index', [$account]))
			->click('Edit')
			->seeText($name)
			->type($new_name, 'name')
			->press('Update');

		//Then
		$this->seePageIs(route('boards.index', [$account]))
			->seeText($new_name);
	}
}
