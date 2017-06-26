<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TrelloAccount;

class DashboardController extends Controller
{
	public function index(TrelloAccount $trello_account)
	{
		return view('dashboard.index', compact('trello_account'));
	}
}
