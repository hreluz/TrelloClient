<?php

use App\Board;
use App\Listing;
use App\Card;

class ArchivedACardTest extends FeatureTestCase
{
	public function test_archive_a_card()
	{
		$account = $this->defaultTrelloAccount();
		$this->actingAs($account->user);

		//Create a Board
		$board = Board::createApi(['name' => str_random()] , $account);

		//Create a List
		$list = Listing::createApi(['name' => str_random()] , $account, $board);

		//Create a Card
		$name  = 'A Card'.str_random();
		$card = Card::createApi(['name' => $name] , $account, $list);

		//Archive a Card
		$archive_url = route('cards.archived',[$account, $list, $card]);
        $this->call('PUT', $archive_url, ['_token' => csrf_token()]);
        $this->followRedirects();

		//Then
		$this->seePageIs(route('cards.index', [$account, $list ]))
			->dontSeeText($name);
	}
}