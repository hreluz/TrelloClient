<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrelloAccount extends Model
{
	protected $fillable = ['trello_token', 'name'];

	//Custom Attribute
	public function getDashboardUrlAttribute()
	{
		return route('dashboard.index', $this->id);
	}

	//Relationships
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}