<?php

namespace App\Http\Request\Validations\Abstracts;

use Exception;
use Resources\lang\ptBR\Messages;
use Resources\lang\ptBR\ValidationTypes;

abstract class ValidatorAbstract
{
    protected static $rules = [];
    protected static $messages = [];

    public static function execute(array $data)
    {
        if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]=="POST") {
            $validation = self::make($data, self::$rules, self::$messages);
            if(isset($validation["errors"]) && count($validation["errors"])) {
                return $validation;
            }
        }
        return false;
    }

    private static function validationArrayForNotIsNull(array $array) {
        if (count($array) == 0) {
            throw new Exception("Array not contain data!");
        }
    }

    public static function make(array $data, array $validations, array $messages = [])
    {
        $arrayReturnError = [];
        self::validationArrayForNotIsNull($data);
        if(!count($validations)) {
            return true;
        }
        $arrayReturnError = self::returnErrorRequired($data, $validations, $arrayReturnError);
        foreach (ValidationTypes::types($validations, $data) as $type => $function) {
            $arrayReturnError = self::returnErrorTypeData($data, $validations, $arrayReturnError, $type, $function);
        }
        $arrayReturnError = self::insertMessages($arrayReturnError, $validations);
        return [
            "code" => 406,
            "message" => "Erro de validação!",
            "errors" => $arrayReturnError
        ];
    }

    private static function returnErrorRequired(array $data, array $validations, $arrayReturnError)
    {
        foreach ( $data as $index=>$d ) {
            if( !$d && in_array($index, array_keys($validations)) && in_array("required", $validations[$index]) ) {
                $arrayReturnError[$index] = ["required"];
            }
        }
        $array_diff_key = array_diff_key($validations, $data);
        foreach ($array_diff_key as $key=>$value) {
            if( in_array("required", $value) ) {
                $arrayReturnError[$key] = ["required"];
            }
        }
        return $arrayReturnError;
    }

    public static function returnErrorTypeData(
        array $data,
        array $validations,
        $arrayReturnError,
        $type,
        callable $callable
    )
    {
        foreach ($data as $index=>$d) {
            if(
                $d &&
                self::validationTypes($validations, $type, $index) &&
                !$callable($d, $type) &&
                in_array($index, array_keys($validations))

            ) {
                $arrayReturnError[$index][] = $type;
            }
        }
        return $arrayReturnError;
    }

    private static function validationTypes($validations, $type, $index)
    {
        $array = $validations[$index];
        $explode = explode("::", $type);
        $simbol = $explode[1] ? '::' : '';
        $preg_grep = preg_grep('/'. $explode[0].$simbol.'.*/', $array);
        return count($preg_grep);
    }

    private static function insertMessages($arrayReturnError, $validations)
    {
        foreach ($arrayReturnError as $index => $error) {
            foreach ($error as $error2) {
                $message = Messages::messageReturn($index, $error2, self::$messages, $validations);
                $arrayReturnError[$index] = [$error2 => $message];
            }
        }
        return $arrayReturnError;
    }
}