<?php
use App\Board;
use App\Listing;
use App\Card;

class EditACardTest extends FeatureTestCase
{
	public function test_edit_a_board()
	{
		$account = $this->defaultTrelloAccount();
		$this->actingAs($account->user);

		//Create a Board
		$board = Board::createApi(['name' => str_random()] , $account);

		//Create List
		$list = Listing::createApi(['name' => str_random()] , $account, $board);

		//Create a Card
		$name = 'anyCardName'.str_random();
		$card = Card::createApi(['name' => $name] , $account, $list);

		//When Editing a Card
		$new_name = 'updatedCard'.str_random();
		$this->visitRoute('cards.index', [$account, $list])
			->click('Edit')
			->seeText($name)
			->type($new_name, 'name')
			->press('Update');

		//Then
		$this->seePageIs(route('cards.index', [$account, $list]))
			->seeText($new_name);
	}
}