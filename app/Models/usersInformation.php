<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;


class usersInformation extends Model
{
    protected $table ='users_information';
    protected $fillable = ['user_id','image','address','study','skills','phone','bio','work'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
