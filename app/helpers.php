<?php

function getCustomerLocation(){
    $userLocation = geoip()->getLocation();
    if(request()->has('lat')){
        $userLocation = (object)request()->only('lat','lon');
    }
    return $userLocation;
}
