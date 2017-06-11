<?php
namespace System;
class Cookie 
{
    /**
     * Application object
     * 
     * @var \System\App
     */
    private $app;
    
    /**
     * Constructor
     * 
     * @param \System\App $app
     */
    public function __construct(App $app)
    {
        $this->app  =   $app;
    }
    
    /**
     * Set a new value to cookie
     * 
     * @param string $key
     * @param mixed $value
     * @param int $durationInDays
     * @return void
     */
    public function set($key, $value, $durationInDays = 30)
    {
        setcookie($key, $value, time() + $durationInDays * 3600 * 24, '', '', FALSE, TRUE);
    }
    
    /**
     * Get value from cookie by the given key
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default  =   NULL)
    {
        return array_get($_COOKIE, $key, $default);
    }
    
    /**
     * Determine if the cookie has the given key
     * 
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $_COOKIE);
    }
    
    /**
     * Remove the given key from cookie
     * 
     * @param string $key
     * @return void
     */
    public function remove($key)
    {
        setcookie($key, NULL, -1);
        unset($_COOKIE[$key]);
    }
    
    /**
     * Get all cookies data
     * 
     * @return array
     */
    public function all()
    {
        return $_COOKIE;
    }
    
    /**
     * Destroy cookie
     * 
     * @return void
     */
    public function destroy()
    {
        foreach (array_keys($this->all()) as $key){
            $this->remove($key);
        }
        $_COOKIE   =   [];
        unset($_COOKIE);
    }
}
