<?php

namespace App\Request;

use App\Helpers\helperString;

class RequestReceived
{

    use helperString;
    private $method;
    private $uri;
    private $host;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->host = $_SERVER['HTTP_HOST'];
    }
    public function getMethod(): string
    {
        return $this->method;
    }

    public function getHeaders(): array
    {
        $headers = [];
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }

    public function getData()
    {
        $data=json_decode(file_get_contents('php://input'),true);
        return $data;
    }

    public function getAutCookie(){
        return $_COOKIE['auth']??null;
    }

    public function getFullUrl(): string
    {
        return "https://$this->host".$this->cleanString('/[^a-zA-Z-]/',$this->getUri());
    }

    public function getUri()
    {
        return $this->cleanString('/[^a-zA-Z-.\/]/',$this->uri);
    }

}