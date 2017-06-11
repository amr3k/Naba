<?php
namespace System\Http;

use System\App;

class Response 
{
    /**
     * Application object
     * 
     * @var \System\App
     */
    private $app;
    
    /**
     * Headers container
     * 
     * @var array
     */
    private $headers    =   [];
    
    /**
     * Content
     * 
     * @var string
     */
    private $content    =   '';
    
    /**
     * Constructor
     * 
     * @param App $app
     */
    public function __construct(App $app) 
    {
        $this->app  =   $app;
    }
    
    /**
     * Set the response output content
     * 
     * @param string $content
     * @return void
     */
    public function setOutput($content)
    {
        $this->content  =   $content;
    }
    
    /**
     * Set the response header
     * 
     * @param string $header
     * @param mixed $value
     * @return void
     */
    public function setHeader($header, $value)
    {
        $this->headers[$header] =   $value;
    }
    
    /**
     * Send the response headers and content
     * 
     * @return void
     */
    public function send()
    {
        $this->sendHeaders();
        $this->sendOutput();
    }
    
    /**
     * Send the response output
     * 
     * @return void
     */
    private function sendHeaders()
    {
        foreach ($this->headers as $header => $value){
            header($header . ':' . $value);
        }
    }
    
    /**
     * Send the response output
     * 
     * @return void
     */
    private function sendOutput()
    {
        echo $this->content;
    }
}
