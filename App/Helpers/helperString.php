<?php

namespace App\Helpers;

trait helperString
{
    private function cleanString($pattern, $uri)
    {
        return preg_replace($pattern, '', $uri);
    }
}