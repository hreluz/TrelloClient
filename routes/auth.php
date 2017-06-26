<?php

//Trello
Route::get('trello_accounts', ['uses' => 'TrelloAccountsController@index', 'as' => 'trello_accounts.index']);
Route::get('trello_accounts/add', ['uses' => 'TrelloAccountsController@add', 'as' => 'trello_accounts.add']);
Route::post('trello_accounts', ['uses' => 'TrelloAccountsController@store', 'as' => 'trello_accounts.store']);


//Dashboard
Route::get('dashboard/{trello_account}',  ['uses' => 'DashboardController@index', 'as' => 'dashboard.index']);

//Boards
Route::get('boards/{account}', ['uses' => 'BoardsController@index', 'as' => 'boards.index']);
Route::get('boards/{account}/create', ['uses' => 'BoardsController@create', 'as' => 'boards.create']);
Route::post('boards/{account}', ['uses' => 'BoardsController@store', 'as' => 'boards.store']);