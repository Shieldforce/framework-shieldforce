<?php

namespace Config\error;

use Exception;
use PDOException;
use Throwable;

class Handle
{
    public function report(Throwable $exception)
    {
        if ($exception instanceof Throwable) { return $exception; }
        if ($exception instanceof Exception) { return $exception; }
        if ($exception instanceof PDOException) { return $exception; }
        { return $exception; }
    }
}