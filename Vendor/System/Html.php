<?php
namespace System;

class Html {
    
    /**
     * Application object
     * 
     * @var \System\App
     */
    protected $app;
    
    /**
     * HTML title
     * 
     * @var string
     */
    private $title;
    
    /**
     * Description
     * 
     * @var string
     */
    private $description;
    
    /**
     * Keywords
     * 
     * @var string
     */
    private $keywords;
    
    /**
     * Constructor
     * 
     * @param \System\App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }
    
    /**
     * Set the title
     * 
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title    =   $title;
    }
    
    /**
     * Get the title
     * 
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Set the description
     * 
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description  =   $description;
    }
    
    /**
     * Get the description
     * 
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Set the keywords
     * 
     * @param string $keywords
     * @return void
     */
    public function setKeywords($keywords)
    {
        $this->keywords =   $keywords;
    }
    
    /**
     * Get the keywords
     * 
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }
}