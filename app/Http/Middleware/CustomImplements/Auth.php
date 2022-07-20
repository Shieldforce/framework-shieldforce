<?php

namespace App\Http\Middleware\CustomImplements;

use App\Sessions\Auth\AuthSession;

class Auth
{
    /**
     * Responsable for execute is middleware
     * @param $request
     * @param $next
     */
    public function handle($request, $next)
    {
        if(!AuthSession::isLogger()) {
            if (session_status() != PHP_SESSION_ACTIVE) {
                session_start();
            }
            $_SESSION["unauthorized"] = true;
            $request->getRouter()->redirect("/login");
        }
        return $next($request);
    }
}