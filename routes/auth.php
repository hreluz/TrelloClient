<?php

//Trello
Route::get('trello_accounts/add', ['uses' => 'TrelloAccountsController@add', 'as' => 'trello_accounts.add']);
Route::post('trello_accounts', ['uses' => 'TrelloAccountsController@store', 'as' => 'trello_accounts.store']);


//Dashboard
Route::get('dashboard/{trello_account}',  ['uses' => 'DashboardController@index', 'as' => 'dashboard.index']);