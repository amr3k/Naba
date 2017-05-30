<?php
use System\App;
if (! function_exists('pre')){
    function pre ($var){
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }
}
if (! function_exists('array_get')){
    function array_get($array, $key, $default = NULL){
        return isset($array[$key])? $array[$key] : $default;
    }
}
if (! function_exists('_e')){
    function _e($value){
        return htmlspecialchars($value);
    }
}
if (! function_exists('assets')){
    function assets($path){
        $app    =   App::getInstance();
        return $app->url->link('Public/' . $path);
    }
}