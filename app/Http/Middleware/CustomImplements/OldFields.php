<?php

namespace App\Http\Middleware\CustomImplements;

class OldFields
{
    /**
     * Responsable for execute is middleware
     * @param $request
     * @param $next
     */
    public function handle($request, $next)
    {
        unset($_SESSION["old_fields"]);
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION["old_fields"] = $request->getPostParams();
        return $next($request);
    }
}