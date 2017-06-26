<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrelloAccount extends Model
{
	protected $fillable = ['trello_token', 'name'];

	//Custom Attribute
	public function getDashboardUrlAttribute()
	{
		return route('boards.index', $this->id);
	}

	public function getKeyUrlAttribute()
	{
		return '?key='.env('TRELLO_KEY').'&token='.$this->trello_token;
	}
	
	//Relationships
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function deleteAllBoards()
	{
		$boards = Board::allApi($this);
		foreach ($boards as $board)
			$board->deleteApi($this);
	}
}