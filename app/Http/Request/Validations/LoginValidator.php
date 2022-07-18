<?php

namespace App\Http\Request\Validations;

use App\Http\Request\Validations\Abstracts\ValidatorAbstract;

class LoginValidator extends ValidatorAbstract
{

    public function __construct()
    {
        parent::$rules = self::rules();
        parent::$messages = self::messages();
    }

    protected static function rules() : array
    {
        return [
            "email" => ["required", "string", "email"],
            "password" => ["required", "string"],
        ];
    }

    protected static function messages() : array
    {
        return parent::$messages = [
            //
        ];
    }

}