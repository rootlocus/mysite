<?php

function random_code(){
 
    return rand(1111, 9999);
}

function local_images($fileName) {
    return config('app.env') == 'local' ? asset('images/'.$fileName) : secure_asset('images/'.$fileName);
}