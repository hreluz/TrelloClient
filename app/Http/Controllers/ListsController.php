<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TrelloAccount as Account;
use App\Board;
use App\Listing;
use Session;

class ListsController extends Controller
{
	public function index(Account $account, $board_id)
	{
		$board = Board::getApi($board_id, $account);
		$lists = Listing::allApi($account, $board);

		return view('lists.index', compact('account','board','lists'));
	}

	public function create(Account $account, $board_id)
	{
		$board = Board::getApi($board_id, $account);
		return view('lists.create', compact('account','board'));
	}

	public function store(Request $request, Account $account, $board_id)
	{
		$this->validate($request,[
			'name' => 'required'
		]);

		$board = Board::getApi($board_id, $account);
		$list = Listing::createApi($request->all(), $account, $board);
		
		$message = $list ? 'List was successfully created' : 'There was an error, please try again !';
		$status = $list ? 'success' : 'danger';

    	Session::flash('alert-'.$status,$message);
    	return redirect( route('lists.index', [$account, $board ]));
	}
}
