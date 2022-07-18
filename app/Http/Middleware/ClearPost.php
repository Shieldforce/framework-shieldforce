<?php

namespace App\Http\Middleware;


use Exception;

class ClearPost
{
    /**
     * Responsable for execute is middleware
     * @param $request
     * @param $next
     */
    public function handle($request, $next)
    {
        return $next($request);
    }
}