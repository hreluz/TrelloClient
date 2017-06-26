<?php
use App\Board;

class DeleteABoardTest extends FeatureTestCase
{
	public function test_delete_a_board()
	{
		$account = $this->defaultTrelloAccount();
		
		$user = $account->user;

		$this->actingAs($user);

		$name = 'Board 511'.str_random(10);

		//Create a Board
		$board = Board::createApi(['name' => $name] , $account);

		//Delete a Board
		$delete_url = route('boards.delete',[$account, $board]);
        $this->call('DELETE', $delete_url, ['_token' => csrf_token()]);
        $this->followRedirects();

		//Then
		$this->seePageIs(route('boards.index', [$account]))
			->dontSeeText($name);
	}
}
