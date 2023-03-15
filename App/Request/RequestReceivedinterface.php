<?php

namespace App\Request;

interface RequestReceivedinterface
{
    public function getMethod();

    public function getHeaders();

    public function getMessage();

    public function getUri();

    public function getFullUrl();

}