<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 2018/11/6
 * Time: 13:48
 */
function test_helper(){
    return 'ok';
}

function route_class(){
    return str_replace('.','-',Route::currentRouteName());
}