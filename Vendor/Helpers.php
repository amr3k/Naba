<?php

use System\App;

if (!function_exists('pre')) {

    /**
     * visualise the given variable in browser
     *
     * @param type $var
     * @return void
     */
    function pre($var)
    {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }

}
if (!function_exists('pred')) {

    /**
     * visualise the given variable in browser and kill the rest of the script
     *
     * @param type $var
     * @return void
     */
    function pred($var)
    {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
        die();
    }

}
if (!function_exists('array_get')) {

    /**
     * Get the value from the given array for the given key if found, Otherwise get the default value
     *
     * @param array $array
     * @param mixed $key
     * @param string/int $default
     * @return mixed $default
     */
    function array_get($array, $key, $default = NULL)
    {
        return isset($array[$key]) ? $array[$key] : $default;
    }

}
if (!function_exists('_e')) {

    /**
     * Escape the given value
     *
     * @param string $value
     * @return string
     */
    function _e($value)
    {
        return htmlspecialchars($value);
    }

}
if (!function_exists('assets')) {

    /**
     * Generate full path for the given URL in public directory
     *
     * @param string $path
     * @return string
     */
    function assets($path)
    {
        $app = App::getInstance();
        return $app->url->link('Public/' . $path);
    }

}

if (!function_exists('avatar')) {

    /**
     * Generate full path for the given image file in Avatar directory
     *
     * @param string $img
     * @return string
     */
    function avatar($img)
    {
        $app = App::getInstance();
        return $app->url->link('Public/uploads/img/avatar/' . '/' . $img);
    }

}
if (!function_exists('url')) {

    /**
     * Generate full path for the given URL
     *
     * @param string $path
     * @return string
     */
    function url($path)
    {
        $app = App::getInstance();
        return $app->url->link($path);
    }

}