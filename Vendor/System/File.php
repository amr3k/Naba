<?php
namespace System;
class File{
    /**
     * Directory separator
     * 
     * @const string
     */
    const DS    =   DIRECTORY_SEPARATOR;
    
    /**
     * Root path
     * 
     * @var string 
     */
    private $root;
    
    /**
     * Constructor
     * 
     * @param string $root
     */
    public function __construct($root) {
        $this->root =   $root;
    }
    
    /**
     * Determine whether the given file path exists
     * 
     * @param string $file
     * @return bool
     */
    public function exists($file){
        return file_exists($this->to($file));
    }
    
    /**
     * Require the given file
     * 
     * @param string $file
     * @return mixed
     */
    public function call($file){
        return require $this->to($file);
    }
    
    /**
     * Generate full path to the given file in Vendor folder
     * 
     * @param string $path
     * @return string
     */
    public function toVendor($path){
        return $this->to('Vendor/' . $path);
    }
    
    /**
     * Generate full path to the given file
     * 
     * @param string $path
     * @return string
     */
    public function to ($path){
        return $this->root . static::DS . str_replace(['/','\\'], static::DS, $path);
    }
}





