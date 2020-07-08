<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';
    protected $fillable = ['user_id','user_id2'];

    public function user1(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function user2(){
        return $this->belongsTo(User::class,'user_id2');
    }

    public function message(){
        return $this->hasMany(Message::class,'chat_id');
    }




}
