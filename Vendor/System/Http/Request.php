<?php
namespace System\Http;
class Request {
    private $url;
    private $baseURL;
    public function prepareUrl()
    {
        $script = preg_replace('~/index.php~i', '', $this->server('SCRIPT_NAME'),1);
        $requestURI = preg_replace('~^'.$script.'~i', '', $this->server('REQUEST_URI'));
        if (strpos($requestURI, '?') !== FALSE)
        {
            list($requestURI, $queryString) = explode('?', $requestURI);
        }
        $this->url    =   $requestURI;
        $this->baseURL  = $this->server('REQUEST_SCHEME') . '://' . $this->server('HTTP_HOST') . $script . '/';
    }
    public function get($key,$default = NULL)
    {
        return array_get($_GET, $key, $default);
    }
    public function post($key, $default = NULL)
    {
        return array_get($_POST, $key, $default);
    }
    public function server ($key, $default = NULL)
    {
        return array_get($_SERVER, $key, $default);
    }
    public function method()
    {
        return $this->server('REQUEST_METHOD');
    }
    public function baseUrl()
    {
        return $this->baseURL;
    }
    public function url()
    {
        return $this->url;
    }
}
