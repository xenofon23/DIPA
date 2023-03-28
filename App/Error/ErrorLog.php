<?php

namespace App\Error;

class ErrorLog
{
    private String $type;
    private String $eventData;
    private int $number;
    private String $message;
    private String $file;
    private String $line;

    /**
     * @param String $type
     * @param String $eventData
     * @param int $number
     * @param String $message
     * @param String $file
     * @param String $line
     */
    public function __construct(string $type, string $eventData, int $number, string $message, string $file, string $line)
    {
        $this->type = $type;
        $this->eventData = $eventData;
        $this->number = $number;
        $this->message = $message;
        $this->file = $file;
        $this->line = $line;
    }

    public function addError(){
        $filePath= './var/logs/'.$this->getCurrentDate().'.txt';
        file_put_contents($filePath,$this->errorString(),FILE_APPEND);

    }


    private function getCurrentDate() {
        return date('d-m-Y');
    }

    private function errorString() {
        return sprintf("Error Type: %s \nEvent Data: %s \nError Number: %d \nError Message: %s \nFile: %s \nLine: %s", $this->type, $this->eventData, $this->number, $this->message, $this->file, $this->line);
    }

}