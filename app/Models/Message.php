<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Message extends Model
{

    use SoftDeletes;
    protected $fillable = ['content','user_id2','user_id','isRead'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function user2(){
        return $this->belongsTo(User::class,'user_id2');
    }
/*
    public function chat(){
        return $this->belongsTo(Chat::class);
    }
*/
}
