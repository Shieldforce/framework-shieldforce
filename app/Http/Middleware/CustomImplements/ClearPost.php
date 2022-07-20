<?php

namespace App\Http\Middleware\CustomImplements;

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