<?php

namespace Resources\lang\ptBR;

class Messages
{
    public static function messageReturn($index, $type, array $customMessage, array $validations)
    {
        $fieldCompare = "";
        if($return = self::validationSepareteTypes($validations, $type, $index)) {
            $fieldCompare = $return[$type];
        }
        $modifyKey = self::modifyKey($index);
        $return = [
            "$index.required"          => $customMessage["$index.required"] ?? "Campo ({$modifyKey}) é obrigatório!",
            "$index.string"            => $customMessage["$index.string"] ?? "Campo ({$modifyKey}) deve ser uma string!",
            "$index.integer"           => $customMessage["$index.integer"] ?? "Campo ({$modifyKey}) deve ser um inteiro!",
            "$index.array"             => $customMessage["$index.array"] ?? "Campo ({$modifyKey}) deve ser um array, 
                                          exemplo ['index'=>'value']",
            "$index.email"             => $customMessage["$index.email"] ?? "Campo ({$modifyKey}) deve seguir as regras 
                                          de um e-mail, exemplo: joao@dominio.com.br!",
            "$index.password"          => $customMessage["$index.password"] ??
                                          "Campo ({$modifyKey}) deve seguir das regras de senha! (letras maiúsculas 
                                          e minúsculas, números, simbolos), exemplo: Senha@123",
            "$index.same::"            => "Conteúdo do campo ({$index}) deve ser idêntico ao do campo ({$fieldCompare})",
        ];
        return $return[$index.".".$type];
    }

    public static function modifyKey($index)
    {
        $return = [
            "email"                       => "E-mail",
            "password"                    => "Senha",
            "terms"                       => "Termos",
            "name"                        => "Nome",
            "password_confirmation"       => "Confirmação de senha",
        ];
        return $return[$index] ?? $index;
    }

    private static function validationSepareteTypes($validations, $type, $index)
    {
        $array_types = [];
        $array = $validations[$index];
        $explode = explode("::", $type);
        $preg_grep = preg_grep('/'. $explode[0].'::.*/', $array);
        foreach ($preg_grep as $typeNew) {
            $explode2 = explode("::", $typeNew);
            $array_types[$explode2[0]."::"] = $explode2[1];
        }
        return $array_types;
    }
}