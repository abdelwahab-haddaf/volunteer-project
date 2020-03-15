<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Message extends Model
{
    use SoftDeletes;
    protected $fillable = ['message','sender_id','receiver_id','isRead'];

    public function user(){
        return $this->belongsTo('App\Models\User');
}

}
