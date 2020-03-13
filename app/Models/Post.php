<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{


    protected $fillable = ['post_type','title','content','address','city_id','user_id'];
    use SoftDeletes;
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function city(){
        return $this->belongsTo('App\Models\City','city_id');
    }



}
