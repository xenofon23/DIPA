<?php

namespace App\Controllers;

use App\Services\tetsService;

class TestController
{
    private tetsService $service;
    private array $test;
    /**
     * @param tetsService $service
     */
    public function __construct(tetsService $service,array $test)
    {
        $this->service = $service;
        $this->test=$test;
    }

    public function mal(){
        echo $this->test['malakia'];
        $this->service->get();
    }

}