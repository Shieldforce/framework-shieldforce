<?php

namespace App\Http\Request\Validations;

use App\Http\Request\Validations\Abstracts\ValidatorAbstract;

class RegisterValidator extends ValidatorAbstract
{

    public function __construct()
    {
        parent::$rules = self::rules();
        parent::$messages = self::messages();
    }

    protected static function rules() : array
    {
        return [
            "email"                 => ["required", "string", "email"],
            "name"                  => ["required", "string"],
            "password"              => ["required", "string"],
            "password_confirmation" => ["required", "string"],
        ];
    }

    protected static function messages() : array
    {
        return parent::$messages = [
            //
        ];
    }

}