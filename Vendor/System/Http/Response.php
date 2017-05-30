<?php
namespace System\Http;
use System\App;
class Response 
{
    private $app;
    private $headers    =   [];
    private $content    =   '';
    public function __construct(App $app) 
    {
        $this->app  =   $app;
    }
    public function setOutput($content)
    {
        $this->content  =   $content;
    }
    public function setHeader($header, $value)
    {
        $this->headers[$header] =   $value;
    }
    public function send()
    {
        $this->sendHeaders();
        $this->sendOutput();
    }
    private function sendHeaders()
    {
        foreach ($this->headers as $header => $value){
            header($header . ':' . $value);
        }
    }
    private function sendOutput()
    {
        echo $this->content;
    }
}
