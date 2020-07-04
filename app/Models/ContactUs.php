<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contact_us';
    protected $fillable = ['user_id','name','email','title','message','isRead'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
