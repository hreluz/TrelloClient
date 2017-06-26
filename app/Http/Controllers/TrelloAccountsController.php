<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TrelloAccount;

class TrelloAccountsController extends Controller
{
	public function index()
	{
		$accounts = TrelloAccount::all();
		return view('trello_accounts.index', compact('accounts'));
	}

	public function add()
	{
		return view('trello_accounts.add');
	}

	public function store(Request $request)
	{
		$this->validate($request,[
			'trello_token' => 'required',
			'name' => 'required'
		]);

		$trello_account = auth()->user()->addTrelloAccount($request->all());
		return redirect($trello_account->dashboard_url);
	}
}
