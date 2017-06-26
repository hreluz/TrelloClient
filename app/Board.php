<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Exception;

class Board extends Model
{
	protected $fillable =  ['id', 'name', 'url', 'shortUrl'];
	protected $casts = ['id' => 'string'];

    public static function allApi(TrelloAccount $account)
	{
		$client =  new \GuzzleHttp\Client();
		$url = self::listUrl($account);
		$res = $client->request('GET', $url);

		$list = json_decode($res->getBody(), true);
		$boards = [];

		foreach ($list as $b):
			$boards[] = new static($b);
		endforeach;

		return $boards;
	}
	
    public static function createApi(Request $request, TrelloAccount $account)
    {
		$client =  new \GuzzleHttp\Client();
		$url = self::createUrl($account);

		$params = [
			'form_params' => [
				'name' => $request->get('name')
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
			abort('404', 'Board not found');
		}
    }

    public function updateApi(Request $request, TrelloAccount $account)
    {
		$client =  new \GuzzleHttp\Client();
		$url = self::getUrl($this->id, $account);

		$params = [
			'form_params' => [
				'name' => $request->get('name')
			],
		];
		
		try {
			$res = $client->request('PUT', $url, $params);
			$attributes = json_decode($res->getBody(), true);
			$board = new static($attributes);
			return $board;
		}
		catch ( Exception $e ) {
			abort('404', 'Board not found');
		}

    }


    //Private methods

    private static function createUrl(TrelloAccount $account)
    {
    	return 'https://api.trello.com/1/boards'.$account->keyUrl;
    }

    private static function listUrl(TrelloAccount $account)
    {
    	return 'https://api.trello.com/1/members/me/boards'.$account->keyUrl;
    }

    private static function getUrl($id, TrelloAccount $account)
    {
    	return 'https://api.trello.com/1/boards/'.$id.$account->keyUrl;
    }

}
