<?php

namespace App\Error;

use App\Helpers\headers;

class ErrorException
{
    use headers;
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
        $errorLog->addError();
        $this->set_headers('json');
        echo json_encode($errorArray,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
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
        $exceptionLog->addException();
        $this->set_headers('json');
        echo json_encode($exceptionArray,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

    }

}