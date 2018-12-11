<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'artist_name', 'album_name', 'number','price','img_link','year','type'
    ];

    public $timestamps = false;

//    /**
//     * The attributes that should be hidden for arrays.
//     *
//     * @var array
//     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Genre');
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('number_of_items');;
    }
}
