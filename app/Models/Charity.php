<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    protected $fillable = ['name','desc','admin_id'];

    public function user(){
        return $this->belongsToMany(User::class,'charity_user');
    }
}
