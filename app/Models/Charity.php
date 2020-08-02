<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    protected $fillable = ['name','desc','user_id','image'];



    public function post(){
        return $this->hasMany(Post::class);
    }

    public function user(){
        return $this->belongsToMany(User::class,'charity_user');
    }

    public function admin(){
        return $this->belongsTo(User::class,'user_id');
    }
}
