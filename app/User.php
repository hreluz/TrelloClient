<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value){
        if(!empty(trim($value)))
            $this->attributes['password'] = \Hash::make($value);
    }

    //Relationships
    public function trello_accounts()
    {
        return $this->hasMany(TrelloAccount::class);
    }


    public function addTrelloAccount(array $data)
    {
        $trello_account = new TrelloAccount($data);
        $this->trello_accounts()->save($trello_account);
        return $trello_account;
    }
}
