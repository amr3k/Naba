<?php
namespace System;

class Url 
{
    /**
     * Application object
     * 
     * @var \System\App
     */
    protected $app;
    
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
     * Get the full link based on the given path
     * 
     * @param string $path
     * @return string
     */
    public function link($path)
    {
        return $this->app->request->baseUrl() . trim($path, '/');
    }
    
    /**
     * Redirect to the given path
     * 
     * @param string $path
     * @return void
     */
    public function redirect($path)
    {
        header('location:' . $this->link($path));
        exit;
    }
}
