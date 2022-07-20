<?php

namespace App\Http\Middleware\CustomImplements;

use App\Sessions\Auth\AuthSession;

class RequireAuthLogout
{
    /**
     * Responsable for execute is middleware
     * @param $request
     * @param $next
     */
    public function handle($request, $next)
    {
        if(AuthSession::isLogger()) {
            $request->getRouter()->redirect("/dashboard");
        }
        return $next($request);
    }


}