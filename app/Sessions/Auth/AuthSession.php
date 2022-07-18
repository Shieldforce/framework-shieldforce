<?php

namespace App\Sessions\Auth;

class AuthSession
{

    /**
     * Init session
     * @return void
     */
    private static function init()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
     * Responsable for execute login
     * @return bool
     */
    public static function login($credentialsVerify)
    {
        self::init();

        $_SESSION["auth"]["user"] = [
            "id"      => $credentialsVerify["id"],
            "email"   => $credentialsVerify["email"],
            "name"    => $credentialsVerify["name"],
        ];

        if(isset($_SESSION["auth"]["user"]["id"])) {
            return true;
        }
        return false;
    }

    /**
     * Responsable for execute logout
     * @return bool
     */
    public static function logout()
    {
        self::init();

        unset($_SESSION["auth"]["user"]);

        return true;
    }

    /**
     * User id logger
     * @return bool
     */
    public static function isLogger()
    {
        self::init();

        return isset($_SESSION["auth"]["user"]["id"]);
    }
}