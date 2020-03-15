<?php

namespace App\models;

use App\Http\Controllers\Admin\posts;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['name','post_id'];

    public function post(){
        return $this->belongsTo(posts::class);
    }
}
