<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
	protected $fillable = ['id' , 'name', 'idBoard'];
	protected $casts = ['id' => 'string'];

    public static function allApi(TrelloAccount $account, Board $board)
	{
		$client =  new \GuzzleHttp\Client();
		$url = self::listUrl($account, $board);
		$res = $client->request('GET', $url);

		$list = json_decode($res->getBody(), true);
		$lists = [];

		foreach ($list as $l):
			$lists[] = new static($l);
		endforeach;

		return $lists;
	}

    public static function createApi($attributes, TrelloAccount $account, Board $board)
    {
		$client =  new \GuzzleHttp\Client();
		$url = self::createUrl($account);
		
		$params = [
			'form_params' => [
				'name' => $attributes['name'],
				'idBoard' => $board->id
			],
		];

		$res = $client->request('POST', $url, $params);

		if($res->getStatusCode() == 200):
			$attributes = json_decode($res->getBody(), true);
			$model = new static($attributes);
			return $model;
		endif;

		return false;
    }

    //Private methods

    private static function createUrl(TrelloAccount $account)
    {
    	return 'https://api.trello.com/1/lists'.$account->keyUrl;
    }

    private static function listUrl(TrelloAccount $account, Board $board)
    {
    	return 'https://api.trello.com/1/boards/'.$board->id.'/lists'.$account->keyUrl;
    }
}
