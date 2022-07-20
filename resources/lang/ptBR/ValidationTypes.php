<?php

namespace Resources\lang\ptBR;

class ValidationTypes
{
    public static function types($validations, $data)
    {
        return [
            "string"          => function ($value, $type=null) use ($validations, $data) {
                if($type=="string") {
                    return is_string($value);
                }
                return true;
            },
            "integer"         => function ($value, $type=null) use ($validations, $data) {
                if($type=="integer") {
                    return is_integer($value);
                }
                return true;
            },
            "email"           => function ($value, $type=null) use ($validations, $data) {
                if($type=="email") {
                    return filter_var($value, FILTER_VALIDATE_EMAIL);
                }
                return true;
            },
            "array"           => function ($value, $type=null) use ($validations, $data) {
                if($type=="array") {
                    return is_array($value);
                }
                return true;
            },
            "password"        => function ($value, $type=null) use ($validations, $data) {
                if($type=="password") {
                    $pattern = "/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/";
                    return preg_match($pattern, $value);
                }
                return true;
            },
            "same::"          => function ($value, $type) use ($validations, $data) {

                $return = self::validationSepareteTypes($validations, $type, $data);
                return $return==$value ?? false;

            },
        ];
    }

    private static function validationSepareteTypes($validations, $type, $data)
    {
        $array_types = [];
        foreach ($validations as $validation) {
            $explode = explode("::", $type);
            $preg_grep = preg_grep('/'. $explode[0].'::.*/', $validation);
            foreach ($preg_grep as $typeNew) {
                $explode2 = explode("::", $typeNew);
                $array_types[$explode2[0]."::"] = $explode2[1];
            }
        }
        return $data[$array_types[$explode2[0]."::"]] ?? null;
    }
}