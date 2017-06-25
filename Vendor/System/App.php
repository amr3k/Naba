<?php

namespace System;

//use Closure;

class App
{

    /**
     * Container
     * 
     * @var array 
     */
    private $container = [];

    /**
     * Application object
     * 
     * @var \System\App
     */
    private static $instance;

    /**
     * Constructor
     * 
     * @param \System\File $file
     */
    private function __construct(File $file)
    {
        $this->share('file', $file);
        $this->registerClasses();
        $this->loadHelpers();
    }

    /**
     * Register classes in SPL auto load register
     * 
     * @return void
     */
    private function registerClasses()
    {
        spl_autoload_register([$this, 'load']);
    }

    /**
     * Get application instance
     * 
     * @param \System\File $file
     * @return \System\Application
     */
    public static function getInstance($file = null)
    {
        if (is_null(static::$instance)) {
            static::$instance = new static($file);
        }
        return static::$instance;
    }

    /**
     * Run the application
     * 
     * @return void
     */
    public function run()
    {
        $this->session->start();
        $this->request->prepareUrl();
        $this->file->call('App/index.php');
        list($controller, $method, $arguments) = $this->route->getProperRoute();
        $output = (string) $this->load->action($controller, $method, $arguments);
        $this->response->setOutput($output);
        $this->response->send();
    }

    /**
     * Load class through autoloading
     * 
     * @param type $class
     * @return void
     */
    public function load($class)
    {
        if (strpos($class, 'App') === 0) {
            $file = $class . '.php';
        } else {
            $file = 'Vendor/' . $class . '.php';
        }
        if ($this->file->exists($file)) {
            $this->file->call($file);
        }
    }

    /**
     * Get shared value dynamically
     * 
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * Get shared value
     * 
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        if (!$this->isSharing($key)) {
            if ($this->isCoreAlias($key)) {
                $this->share($key, $this->createNewCoreObject($key));
            } else {
                die('<b>' . $key . '</b>' . 'is not found in app container');
            }
        }
        return $this->container[$key];
    }

    /**
     * Share the given key/value through Application
     * 
     * @param type $key
     * @param type $value
     * @return mixed
     */
    public function share($key, $value)
    {
        if ($value instanceof \Closure) {
            $value = call_user_func($value, $this);
        }
        $this->container[$key] = $value;
    }

    /**
     * Determine if the given key is shared through Application
     * 
     * @param string $key
     * @return bool
     */
    public function isSharing($key)
    {
        return isset($this->container[$key]);
    }

    /**
     * Determine if the given key is an alias to core class
     * 
     * @param string $alias
     * @return bool
     */
    private function isCoreAlias($alias)
    {
        $coreClasses = $this->coreClasses();
        return isset($coreClasses[$alias]);
    }

    /**
     * Create new object for the core class based on the given alias
     * 
     * @param string $alias
     * @return object
     */
    private function createNewCoreObject($alias)
    {
        $coreClasses = $this->coreClasses();
        $object      = $coreClasses[$alias];
        return new $object($this);
    }

    /**
     * Get all core classes with its aliases
     * 
     * @return array
     */
    private function coreClasses()
    {
        return [
            'request'   => 'System\\Http\\Request',
            'response'  => 'System\\Http\\Response',
//            'upload'        =>  'System\\Http\\UploadedFiles',
            'route'     => 'System\\Route',
            'load'      => 'System\\Loader',
            'session'   => 'System\\Session',
            'cookie'    => 'System\\Cookie',
            'html'      => 'System\\Html',
            'db'        => 'System\\Database',
            'view'      => 'System\\View\\ViewFactory',
            'url'       => 'System\\Url',
            'validator' => 'System\\Validation',
        ];
    }

    /**
     * Load helpers file
     * 
     * @return void
     */
    private function loadHelpers()
    {
        $this->file->call('Vendor/Helpers.php');
    }

}
