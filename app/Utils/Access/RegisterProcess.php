<?php

namespace App\Utils\Access;

class RegisterProcess
{
    public static function credentialsVerifyIsExistUser($data) : bool|array
    {
        $auth = self::auth();

        if(
            isset($auth["email"]) && $auth["email"]==$data["email"]
        ) {
            return $auth;
        }
        return false;
    }

    private static function auth()
    {
        return [
            "email"    => "shieldforce2@gmail.com",
        ];
    }
}