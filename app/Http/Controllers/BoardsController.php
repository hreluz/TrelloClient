<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\TrelloAccount as Account;
use Session;

class BoardsController extends Controller
{
	public function index(Account $account)
	{
		$boards = Board::allApi($account);

		return view('boards.index',compact('account','boards'));
	}

	public function create(Account $account)
	{
		return view('boards.create', compact('account'));
	}

	public function store(Request $request, Account $account)
	{
		$this->validate($request,[
			'name' => 'required'
		]);

		$board = Board::createApi($request, $account);
		
		$message = $board ? 'Board was successfully created' : 'There was an error, please try again !';
		$status = $board ? 'success' : 'danger';

    	Session::flash('alert-'.$status,$message);
    	return redirect(route('boards.index',$account ));
	}

	public function edit(Account $account, $board_id)
	{
		$board = Board::getApi($board_id, $account);
		return view('boards.edit', compact('account', 'board'));
	}

	public function update(Request $request, Account $account, $board_id)
	{
		$this->validate($request,[
			'name' => 'required'
		]);

		$board = Board::getApi($board_id, $account);
		$board = $board->updateApi($request, $account);	
    	return redirect(route('boards.index',$account ));
	}
}
