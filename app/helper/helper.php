<?php

use App\Models\Charity;
use App\Models\Message;
use App\models\usersInformation;
use Illuminate\Support\Facades\Auth;

function isActive($roueName){
    return null!==request()->segment(2)&& request()->segment(2)==$roueName ? 'active' : "" ;
}

function activeList($roueName){
    return null!==request()->segment(1)&& request()->segment(1)==$roueName ? 'active-list' : "" ;
}



?>
