<?php

 function isActive($roueName){
    return null!==request()->segment(2)&& request()->segment(2)==$roueName ? 'active' : "" ;
}


?>
