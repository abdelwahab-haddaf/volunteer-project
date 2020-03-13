<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use softDeletes;
    protected $fillable = ['name','desc'];

    public function posts(){
        return $this->belongsToMany(Post::class);
    }




}
