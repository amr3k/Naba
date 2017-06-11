<?php
namespace System\View;

interface ViewInterface
{
    /**
     * Get the view output
     * 
     * @return string
     */
    public function getOutput();
    
    /**
     * Convert the view object to string in printing
     * i.e echo $object;
     */
    public function __toString();
}
