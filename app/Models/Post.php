<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{

    protected $fillable = ['post_type','title','content','address','city_id','user_id','charity_id'];
    use SoftDeletes;
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class,'category_post');
    }


    public function charity(){
        return $this->belongsTo(Charity::class);
    }

    public function image(){
        return $this->hasMany(Image::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }

}
