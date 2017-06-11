<?php
namespace System;

abstract class Controller
{
    /**
     * Application object
     * 
     * @var \System\App
     */
    protected $app;
    
    /**
     * Errors container
     * 
     * @var array
     */
    protected $errors   =   [];
    /**
     * Constructor
     * 
     * @param \System\App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }
    
    /**
     * Encode the given value to JSON
     * 
     * @param mixed $data
     * @return string
     */
    public function json($data)
    {
        return json_encode($data);
    }

    /**
     * Call shared application objects dynamically
     * 
     * @param string $key
     * @return mixed
     */
    public function __get($key) {
        return $this->app->get($key);
    }
}
