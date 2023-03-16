<?php

namespace App\Error;

class ExceptionLog
{
    private String $type;
    private String $eventData;
    private array $trace;
    private String $message;
    private String $file;
    private String $line;

    /**
     * @param String $type
     * @param String $eventData
     * @param array $trace
     * @param String $message
     * @param String $file
     * @param String $line
     */
    public function __construct(string $type, string $eventData, array $trace, string $message, string $file, string $line)
    {
        $this->type = $type;
        $this->eventData = $eventData;
        $this->trace = $trace;
        $this->message = $message;
        $this->file = $file;
        $this->line = $line;
    }


    public function addException(): void
    {
        $filePath= './var/logs/'.$this->getCurrentDate().'.txt';
        file_put_contents($filePath,$this->errorString(),FILE_APPEND);

    }


    private function getCurrentDate() {
        return date('d-m-Y');
    }

    private function errorString() {
        return sprintf("Error Type: %s \nEvent Data: %s \nError Number: %d \nError Message: %s \nFile: %s \nLine: %s", $this->type, $this->eventData, $this->trace, $this->message, $this->file, $this->line);
    }

}