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

    public static function getApi($id, TrelloAccount $account)
    {
		$client =  new \GuzzleHttp\Client();

		$url = self::getUrl($id, $account);

		try {
			$res = $client->request('GET', $url);
			$attributes = json_decode($res->getBody(), true);
			$board = new static($attributes);
			return $board;
		}
		catch ( Exception $e ) {
			abort('404', 'Card not found');
		}
    }

    public function updateApi($attributes, TrelloAccount $account, Listing $list)
    {
		$client =  new \GuzzleHttp\Client();
		$url = self::getUrl($this->id, $account);
		
		$params = [
			'form_params' => [
				'name' => $attributes['name'],
				'idList' => $list->id
			],
		];
		
		try {
			$res = $client->request('PUT', $url, $params);
			$attributes = json_decode($res->getBody(), true);
			$list = new static($attributes);
			return $list;
		}
		catch ( Exception $e ) {
			abort('404', 'Card not found');
		}

    }

    public function archivedApi(TrelloAccount $account, Listing $list)
    {
		$client =  new \GuzzleHttp\Client();
		$url = self::archivedUrl($this->id, $account);

		$params = [
			'form_params' => [
				'idList' => $list->id
			],
		];
		
		try {
			$res = $client->request('PUT', $url, $params);
			$attributes = json_decode($res->getBody(), true);
			$list = new static($attributes);
			return $list;
		}
		catch ( Exception $e ) {
			abort('404', 'Card not found');
		}

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

    private static function getUrl($id, TrelloAccount $account)
    {
    	return  'https://api.trello.com/1/cards/'.$id.$account->keyUrl;
    }

    private static function archivedUrl($id, TrelloAccount $account)
    {
    	return 'https://api.trello.com/1/cards/'.$id.$account->keyUrl.'&closed=true';
    }

}
