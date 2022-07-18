<?php

namespace App\Http\Middleware;


use Exception;

class Maintenance
{
    /**
     * Responsable for execute is middleware
     * @param $request
     * @param $next
     */
    public function handle($request, $next)
    {
        if(env("APP_MAINTENACE")=="true") {
            throw new Exception("Page under maintenance!", 200);
        }
        return $next($request);
    }
}