<?php
namespace System\View;
use System\File;
class View implements ViewInterface 
{
    private $file;
    private $viewPath;
    private $data   =   [];
    private $output;
    public function __construct(File $file, $viewPath, array $data  =   []) 
    {
        $this->file     =   $file;
        $this->preparePath($viewPath);
        $this->data     =   $data;
    }
    private function preparePath($viewPath)
    {
        $full_path      =   'App/Views/' . $viewPath . '.php';
        $this->viewPath = $this->file->to($full_path);
        if (! $this->viewFileExists($full_path)) {
            die('<b>' . $viewPath . '</b>' . ' doesn\'t exist in Views');
        }
    }
    private function viewFileExists($viewPath)
    {
        return $this->file->exists($viewPath);
    }
    public function getOutput() 
    {
        if (is_null($this->output)){
            ob_start();
            extract($this->data);
            require $this->viewPath;
            $this->output   = ob_get_clean();
        }
        return $this->output;
    }
    public function __toString() 
    {
        return $this->getOutput();
    }
}
