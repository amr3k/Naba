<?php
use System\App;

if (! function_exists('pre')){
    /**
     * Visualize the given variable in browser
     * 
     * @param type $var
     * @return void
     */
    function pre ($var){
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }
}
if (! function_exists('array_get')){
    /**
     * Get the value from the given array for the given key if found, Otherwise get the default value
     * 
     * @param array $array
     * @param mixed $key
     * @param string/int $default
     * @return mixed $default
     */
    function array_get($array, $key, $default = NULL){
        return isset($array[$key]) ? $array[$key] : $default;
    }
}
if (! function_exists('_e')){
    /**
     * Escape the given value
     * 
     * @param string $value
     * @return string
     */
    function _e($value){
        // Once again I created this if condition beacause of that f***g error "array to string conversion"
        if (is_array($value)){
            return htmlspecialchars($value[0]);
        }else{
            return htmlspecialchars($value);
        }
    }
}
if (! function_exists('assets')){
    /**
     * Generate full path for the given URL in public directory
     * 
     * @param string $path
     * @return string
     */
    function assets($path){
        $app    =   App::getInstance();
        return $app->url->link('Public/' . $path);
    }
}
if (! function_exists('url')){
    /**
     * Generate full path for the given URL
     * 
     * @param string $path
     * @return string
     */
    function url($path){
        $app    =   App::getInstance();
        return $app->url->link($path);
    }
}