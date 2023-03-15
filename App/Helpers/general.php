<?php

namespace App\Helpers;



trait general
{
    public function convertPageData($pagesData){
       return json_encode($pagesData['template']['{{data}}'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function getContent($path){
        return file_get_contents($path);
    }

    private function checkHtml($string ){
        if (preg_match('/\.html$/', $string)) {
           return true;
        }
        return false;
    }

    public function checkMaintenanceMode()
    {
        if (getenv('MAINTENANCE') ==='true') {

            die('trompetes');
        }

    }

}