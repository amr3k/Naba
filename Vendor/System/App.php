<?php
namespace System;
class App
{
    private $container  =   [];
    private static $instance;
    private function __construct(File $file)
    {
        $this->share('file', $file);
        $this->registerClasses();
        $this->loadHelpers();
    }
    public static function getInstance($file = null)
    {
        if (is_null(static::$instance))
        {
            static::$instance   =   new static($file);
        }
        return static::$instance;
    }
    public function run()
    {
        $this->session->start();
        $this->request->prepareUrl();
        $this->file->call('App/index.php');
        list($controller, $method, $arguments)  =   ($this->route->getProperRoute());
        pre($this->route->getProperRoute());
        $output =   $this->load->action($controller, $method, $arguments);
        $this->response->setOutput($output);
        $this->response->send();
    }
    public function share($key, $value){
        $this->container[$key]  =   $value;
    }
    private function isCoreAlias($alias){
        $coreClasses    = $this->coreClasses();
        return isset($coreClasses[$alias]);
    }
    private function createNewCoreObject($alias){
        $coreClasses    =   $this->coreClasses();
        $object     =   $coreClasses[$alias];
        return new $object($this);
    }
    private function coreClasses(){
        return [
            'request'       =>  'System\\Http\\Request',
            'response'      =>  'System\\Http\\Response',
            'session'       =>  'System\\Session',
            'route'         =>  'System\\Route',
            'cookie'        =>  'System\\Cookie',
            'load'          =>  'System\\Loader',
            'html'          =>  'System\\Html',
            'db'            =>  'System\\Database',
            'view'          =>  'System\\View\\ViewFactory',
            'url'           =>  'System\\Url'
        ];
    }
    public function __get($key) {
        return $this->get($key);
    }
    public function get($key){
        if (!$this->isSharing($key)){
            if ($this->isCoreAlias($key)){
                $this->share($key, $this->createNewCoreObject($key));
            } else {
                die($key . 'is not found in app container');
            }
        }
        return $this->container[$key];
    }
    public function isSharing($key){
        return isset($this->container[$key]);
    }
    private function registerClasses(){
        spl_autoload_register([$this,'load']);
    }
    public function load($class){
        if (strpos($class, 'App') === 0){
            $file   = $class . '.php';
        }else {
            $file   = 'Vendor/'.$class . '.php';
        }
        if ($this->file->exists($file)){
                $this->file->call($file);
        }
    }
    private function loadHelpers(){
        $this->file->call('Vendor/Helpers.php');
    }
}