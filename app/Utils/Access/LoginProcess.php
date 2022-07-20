<?php

namespace App\Utils\Access;

use Config\crypt\Crypt;

class LoginProcess
{
    public static function credentialsVerify($data) : bool|array
    {
        $auth = self::auth();

        if(
            isset($auth["email"]) && $auth["email"]==$data["email"] &&
            isset($auth["password"]) && Crypt::decrypt($auth["password"])==$data["password"]
        ) {
            return $auth;
        }
        return false;
    }

    private static function auth()
    {
        return [
            "id"       => 1,
            "email"    => "shieldforce2@gmail.com",
            "password" => Crypt::encrypt("1234"),
            "name"     => "Alexandre Ferreira"
        ];
    }
}