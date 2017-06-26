<?php
use App\Board;
use App\Listing;

class EditAListTest extends FeatureTestCase
{
	public function test_edit_a_board()
	{
		$account = $this->defaultTrelloAccount();
		$board = Board::createApi(['name' => 'AnyBoardName'.str_random()] , $account);
		
		$user = $account->user;

		$this->actingAs($user);

		//Create a List
		$name = 'anyListName'.str_random();
		$list = Listing::createApi(['name' => $name] , $account, $board);

		//When Editing a List
		$new_name = 'updatedListName'.str_random();
		$this->visitRoute('lists.index', [$account, $board])
			->click('Edit')
			->seeText($name)
			->type($new_name, 'name')
			->press('Update');

		//Then
		$this->seePageIs(route('lists.index', [$account, $board]))
			->seeText($new_name);
	}
}
