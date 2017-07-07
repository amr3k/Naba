<?php

use System\App;

if (!function_exists('pre')) {

    /**
     * visualise the given variable in browser
     *
     * @param mixed $var
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
        die;
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
if (!function_exists('read_more')) {

    /**
     * Cut the given string and get the given number of words from it
     *
     * @param string $string
     * @param int $number_of_words
     * @return string
     */
    function read_more($string, $number)
    {
        // remove any empty values in the exploded array
        $words = array_filter(explode(' ', $string));

        // if the total words of the given string is less than or equal to
        // the given number of words parameter
        // then we will just return the whole string
        // assume $sting has 10 words
        // and the $number_of_words = 20
        // number of words is bigger than the number of given string words
        // in this case we will just return the string
        if (count($words) <= $number) {
            return $string;
        }

        return implode(' ', array_slice($words, 0, $number)) . '...';
    }

}

if (!function_exists('seo')) {

    /**
     * Remove any unwanted characters from the given string
     * and replace it with -
     *
     * @param string $string
     * @return string
     */
    function seo($string)
    {
        // remove any white spaces from the beginning and
        //the end of the given string
        $string = trim($string);

        // replace any non English or numeric characters and dashes with white space
        $string = preg_replace('#[^\w]#', ' ', $string);

        // replace any multi white spaces with just one white space
        $string = preg_replace('#[\s]+#', ' ', $string);

        // replace white spaces with dash
        $string = str_replace(' ', '-', $string);

        // make all letters in small case letters
        // and trim any dashes
        return trim(strtolower($string), '-');
    }

}
