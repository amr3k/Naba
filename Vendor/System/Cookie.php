<?php
namespace System;
class Cookie 
{
    private $app;
    public function __construct($app)
    {
        $this->app  =   $app;
    }
    public function set($key, $value, $durationInDays = 30)
    {
        setcookie($key, $value, time() + $durationInDays * 3600 * 24, '', '', FALSE, TRUE);
    }
    public function get($key, $default  =   NULL)
    {
        return array_get($_COOKIE, $key, $default);
    }
    public function has($key)
    {
        return array_key_exists($key, $_COOKIE);
    }
    public function remove($key)
    {
        setcookie($key, NULL, -1);
        unset($_COOKIE[$key]);
    }
    public function all()
    {
        return $_COOKIE;
    }
    public function destroy()
    {
        foreach (array_keys($this->all()) as $key){
            $this->remove($key);
        }
        $_COOKIE   =   [];
    }
}
