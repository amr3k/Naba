<?php
namespace System;
class Route {
    private $app;
    public $routes =   [];
    private $notFound;
    public function __construct(App $app) {
        $this->app  =   $app;
    }
    public function add($url, $action, $requestMethod = 'GET')
    {
        $route  =   [
            'url'       =>  $url,
            'pattern'   =>  $this->generatePattern($url),
            'action'    =>  $this->getAction($action),
            'method'    =>  strtoupper($requestMethod),
        ];
        $this->routes[]   =   $route;
    }
    public function notFound($url)
    {
        $this->notFound =   $url;
    }
    public function getProperRoute()
    {
        foreach ($this->routes as $route)
        {
            if ($this->isMatching($route['pattern']))
            {
                $arguments  = $this->getArgumentsFrom($route['pattern']);
                list($controller, $method)  =   explode('@', $route['action']);
//                pre($arguments);
                return [$controller, $method, $arguments];
            } 
            else{
//                echo '<br><b>notMatching</b> ' . $route['url'] . '<br>';
            }
        }
    }
    private function isMatching($pattern)
    {
//        echo preg_match($pattern, $this->app->request->url());
//        echo ' : <b>' . $pattern . '</b><br>';
        return preg_match($pattern, $this->app->request->url());
    }
    private function getArgumentsFrom($pattern)
    {
        preg_match($pattern, $this->app->request->url(),$matches);
//        pre($matches);
        array_shift($matches);
        return $matches;
    }
    private function generatePattern($url)
    {
        $pattern    =   '#^';
        $pattern    .=  str_replace([':text', ':id'], ['([A-Za-z0-9-]+)', '(\d+)'], $url);
        $pattern    .=  '$#';
        return $pattern;
    }
    private function getAction($action)
    {
        $action = str_replace('/', '\\', $action);
        return strpos($action, '@') !== FALSE ? $action : $action . '@index';
    }
}













