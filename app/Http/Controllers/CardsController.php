<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TrelloAccount as Account;
use App\Listing;
use App\Card;
use Session;

class CardsController extends Controller
{
	public function index(Account $account, $list_id)
	{
		$list = Listing::getApi($list_id, $account);
		$cards = Card::allApi($account, $list);

		return view('cards.index', compact('account','list','cards'));
	}

	public function create(Account $account, $list_id)
	{
		$list = Listing::getApi($list_id, $account);
		return view('cards.create', compact('account','list'));
	}

	public function store(Request $request, Account $account, $list_id)
	{
		$this->validate($request,[
			'name' => 'required'
		]);

		$list = Listing::getApi($list_id, $account);
		$card = Card::createApi($request->all(), $account, $list);
		
		$message = $list ? 'Card was successfully created' : 'There was an error, please try again !';
		$status = $list ? 'success' : 'danger';

    	Session::flash('alert-'.$status,$message);
    	return redirect( route('cards.index', [$account, $list ]));
	}

	public function edit(Account $account, $list_id, $card_id)
	{
		$list = Listing::getApi($list_id, $account);
		$card = Card::getApi($card_id, $account);

		return view('cards.edit', compact('account', 'list','card'));
	}

	public function update(Request $request, Account $account, $list_id, $card_id)
	{
		$this->validate($request,[
			'name' => 'required'
		]);
		$list = Listing::getApi($list_id, $account);
		$card = Card::getApi($card_id, $account);
		$card = $card->updateApi($request->all(), $account, $list);	

    	return redirect( route('cards.index', [$account, $list ]));
	}

	public function archived(Account $account, $list_id, $card_id)
	{
		$list = Listing::getApi($list_id, $account);
		$card = Card::getApi($card_id, $account);
		$card->archivedApi($account, $list);

    	return redirect( route('cards.index', [$account, $list ]));
	}
}