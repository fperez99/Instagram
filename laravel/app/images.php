<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    protected $table='images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'image_path', 'description'
    ];

    public function comments(){
        return $this->hasMany('App\Comment')->orderBY('id','desc');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function likes(){
        return $this->hasMany('App\Like')->orderBY('id','desc');
    }

}