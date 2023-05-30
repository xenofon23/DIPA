<?php

namespace App\Error;

use App\Helpers\headers;
use App\View\Page;
use Exception;

class ErrorException
{
    use headers;

    /**
     * @throws Exception
     */
    public function errorCallback(int $errNo, string $errMsg, string $errFile, int $errLine)
    {
        $time = date("Y-m-d H:i:s");
        $errorArray = [
            "type" => "error",
            "eventData" => $time,
            "number" => $errNo,
            "message" => $errMsg,
            "file" => $errFile,
            "line" => $errLine
        ];
        $errorLog=new ErrorLog('error',$time,$errNo,$errMsg,$errFile,$errLine);
//        $this->set_headers('json');
//        die(json_encode($errMsg,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
        throw new Exception('page does not and in .html');

    }

    public function exceptCallback(\Throwable $e )
    {

        $time = date("Y-m-d H:i:s");
        $exceptionArray = [
            "type" => "exception",
            "eventData" => $time,
            "message" => $e->getMessage(),
            "file" => $e->getFile(),
            "line" => $e->getLine(),
            "trace" => $e->getTrace()
        ];
        $exceptionLog=new ExceptionLog('exception',$time,$e->getTrace(),$e->getMessage(),$e->getFile(),$e->getLine());
        $this->set_headers('html');
//        die(json_encode($exceptionArray,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
        $page=new Page();
        die($page->generatePage('/oops.html'));

    }

}