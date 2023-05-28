<?php

namespace App\Helpers;

trait helperString
{
    private function cleanString($pattern, $uri)
    {
        return preg_replace($pattern, '', $uri);
    }
    public function sanitizeData($data)
    {
        if (is_array($data)) {
            return array_map([$this, 'sanitizeData'], $data);
        }

        return filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
    }
}