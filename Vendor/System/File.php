<?php
namespace System;
class File{
    const DS    =   DIRECTORY_SEPARATOR;

    private $root;
    public function __construct($root) {
        $this->root =   $root;
    }
    public function exists($file){
        return file_exists($this->to($file));
    }
    public function call($file){
        return require $this->to($file);
    }
    public function toVendor($path){
        return $this->to('Vendor/'.$path);
    }
    public function to ($path){
        return $this->root . static::DS . str_replace(['/','\\'], static::DS, $path);
    }
}