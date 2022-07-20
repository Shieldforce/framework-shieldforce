<?php

namespace Config\crypt;

class Crypt
{
    public static function encrypt($value)
    {
        $rootPath = env("ROOT_PATH");
        $fileDecrypt = "{$rootPath}/setup/crypt.sh";
        return str_replace(["\n"],[""], shell_exec("bash $fileDecrypt {$value}"));
    }

    public static function decrypt($value)
    {
        $rootPath = env("ROOT_PATH");
        $fileDecrypt = "{$rootPath}/setup/decrypt.sh";
        return str_replace(["\n"],[""], shell_exec("bash $fileDecrypt {$value}"));
    }
}