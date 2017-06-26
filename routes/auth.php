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

Route::get('boards/{account}/edit/{board}', ['uses' => 'BoardsController@edit', 'as' => 'boards.edit']);
Route::put('boards/{account}/{board}', ['uses' => 'BoardsController@update', 'as' => 'boards.update']);
Route::delete('boards/{account}/{board}', ['uses' => 'BoardsController@delete', 'as' => 'boards.delete']);

//Lists
Route::get('lists/{account}/{board}', ['uses' => 'ListsController@index', 'as' => 'lists.index']);

Route::get('lists/{account}/create/{board}', ['uses' => 'ListsController@create', 'as' => 'lists.create']);
Route::post('lists/{account}/{board}', ['uses' => 'ListsController@store', 'as' => 'lists.store']);

Route::get('lists/{account}/{board}/edit/{list}', ['uses' => 'ListsController@edit', 'as' => 'lists.edit']);
Route::put('lists/{account}/{board}/{list}', ['uses' => 'ListsController@update', 'as' => 'lists.update']);
Route::put('lists/{account}/{board}/archived/{list}', ['uses' => 'ListsController@archived', 'as' => 'lists.archived']);

//Cards
Route::get('cards/{account}/{list}', ['uses' => 'CardsController@index', 'as' => 'cards.index']);

Route::get('cards/{account}/create/{list}', ['uses' => 'CardsController@create', 'as' => 'cards.create']);
Route::post('cards/{account}/{list}', ['uses' => 'CardsController@store', 'as' => 'cards.store']);

Route::get('cards/{account}/{list}/edit/{card}', ['uses' => 'CardsController@edit', 'as' => 'cards.edit']);
Route::put('cards/{account}/{list}/{card}', ['uses' => 'CardsController@update', 'as' => 'cards.update']);