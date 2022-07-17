<?php

namespace Config\error;

use Exception;
use PDOException;
use Throwable;

class Handle
{
    private $code;
    private $file;
    private $line;
    private $previous;
    private $trace;
    private $trace_string;
    private $message;

    public function report(Throwable $exception)
    {
        $arrayError = [];

        if ($exception instanceof Throwable) {
           $arrayError["code"] = $exception->getCode();
           $arrayError["file"] = $exception->getFile();
           $arrayError["line"] = $exception->getLine();
           $arrayError["previous"] = $exception->getPrevious();
           $arrayError["trace"] = $exception->getTrace();
           $arrayError["trace_string"] = $exception->getTraceAsString();
           $arrayError["message"] = $exception->getMessage();
        }

        if ($exception instanceof Exception) {
            $arrayError["code"] = $exception->getCode();
            $arrayError["file"] = $exception->getFile();
            $arrayError["line"] = $exception->getLine();
            $arrayError["previous"] = $exception->getPrevious();
            $arrayError["trace"] = $exception->getTrace();
            $arrayError["trace_string"] = $exception->getTraceAsString();
            $arrayError["message"] = $exception->getMessage();
        }

        if ($exception instanceof PDOException) {
            $arrayError["code"] = $exception->getCode();
            $arrayError["file"] = $exception->getFile();
            $arrayError["line"] = $exception->getLine();
            $arrayError["previous"] = $exception->getPrevious();
            $arrayError["trace"] = $exception->getTrace();
            $arrayError["trace_string"] = $exception->getTraceAsString();
            $arrayError["message"] = $exception->getMessage();
        }

        $_SESSION["error_session"] = $arrayError;
        $this->setCode($_SESSION["error_session"]["code"]);
        $this->setFile($_SESSION["error_session"]["file"]);
        $this->setLine($_SESSION["error_session"]["line"]);
        $this->setPrevious($_SESSION["error_session"]["previous"]);
        $this->setTrace($_SESSION["error_session"]["trace"]);
        $this->setTraceString($_SESSION["error_session"]["trace_string"]);
        $this->setMessage($_SESSION["error_session"]["message"]);
    }

    private function setCode($code)
    {
        $this->code = $code;
    }

    private function setFile($file)
    {
       $this->file = $file;
    }

    private function setLine($line)
    {
        $this->line = $line;
    }

    private function setPrevious($previous)
    {
        $this->previous = $previous;
    }

    private function setTrace($trace)
    {
        $this->trace = $trace;
    }

    private function setTraceString($trace_string)
    {
        $this->trace_string = $trace_string;
    }

    private function setMessage($message)
    {
        $this->message = $message;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getFile()
    {
       return $this->file;
    }

    public function getLine()
    {
       return $this->line;
    }

    public function getPrevious()
    {
       return $this->previous;
    }

    public function getTrace()
    {
       return $this->trace;
    }

    public function getTraceString()
    {
       return $this->trace_string;
    }

    public function getMessage()
    {
       return $this->message;
    }
}