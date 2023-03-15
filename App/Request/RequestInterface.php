<?php

namespace App\Request;

interface RequestInterface
{
    function setUrl(string $url);
    public function setMethod(string $method);
    public function setData($data);
    public function setHeaders(array $headers);


}