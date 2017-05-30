<?php
namespace System\View;
use System\App;
class ViewFactory 
{
    private $app;
    public function __construct(App $app) 
    {
        $this->app  =   $app;
    }
    public function render($viewPath, array $data   =   [])
    {
        return new View($this->app->file, $viewPath, $data);
    }
}