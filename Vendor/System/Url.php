<?php
namespace System;

class Url 
{
    protected $app;
    public function __construct(App $app)
    {
        $this->app  =   $app;
    }
    public function link($path)
    {
        return $this->app->request->baseUrl() . trim($path, '/');
    }
    public function redirect($path)
    {
        header('location:' . $this->link($path));
        exit;
    }
}
