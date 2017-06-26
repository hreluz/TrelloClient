<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
	protected $fillable = ['id' , 'name', 'idBoard', 'idList'];
	protected $casts = ['id' => 'string'];

    public static function allApi(TrelloAccount $account, Listing $list)
	{
		$client =  new \GuzzleHttp\Client();
		$board = Board::getApi($list->idBoard, $account);
		$url = self::listUrl($account, $board);
		$res = $client->request('GET', $url);

		$list = json_decode($res->getBody(), true);
		$cards = [];

		foreach ($list as $c):
			$cards[] = new static($c);
		endforeach;

		return $cards;
	}

    public static function createApi($attributes, TrelloAccount $account, Listing $list)
    {
		$client =  new \GuzzleHttp\Client();
		$url = self::createUrl($account);
		
		$params = [
			'form_params' => [
				'name' => $attributes['name'],
				'idList' => $list->id
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
    	return 'https://api.trello.com/1/cards'.$account->keyUrl;
    }

    private static function listUrl(TrelloAccount $account, Board $board)
    {
    	return 'https://api.trello.com/1/boards/'. $board->id .'/cards'.$account->keyUrl;
    }
}
