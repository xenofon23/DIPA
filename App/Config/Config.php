<?php

namespace App\Config;
use App\Error\errorException;

class Config
{


    public function __construct()
    {
        $this->conf();
    }

    public function conf(){
        $error = new ErrorException();
        set_error_handler([$error, 'errorcallback']);
        set_exception_handler([$error, 'exceptCallback']);
    }
}