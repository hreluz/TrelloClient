<?php

use App\Board;
use App\Listing;

class ArchivedAListTest extends FeatureTestCase
{
	public function test_archive_a_list()
	{
		$account = $this->defaultTrelloAccount();
		$this->actingAs($account->user);

		//Create a Board
		$board = Board::createApi(['name' => str_random()] , $account);

		//Create a List
		$name = 'anyListName'.str_random();
		$list = Listing::createApi(['name' => $name] , $account, $board);

		//Archive a List
		$archive_url = route('lists.archived',[$account, $board, $list]);
        $this->call('PUT', $archive_url, ['_token' => csrf_token()]);
        $this->followRedirects();

		//Then
		$this->seePageIs(route('lists.index', [$account, $board ]))
			->dontSeeText($name);
	}
}
