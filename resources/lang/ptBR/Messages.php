<?php

namespace Resources\lang\ptBR;

class Messages
{
    public static function messageReturn($index, $type, array $customMessage)
    {
        $modifyKey = self::modifyKey($index);
        $return = [
            "$index.required"    => $customMessage["$index.required"] ?? "Campo ({$modifyKey}) é obrigatório!",
            "$index.string"      => $customMessage["$index.string"] ?? "Campo ({$modifyKey}) deve ser uma string!",
            "$index.integer"     => $customMessage["$index.integer"] ?? "Campo ({$modifyKey}) deve ser um inteiro!",
            "$index.array"       => $customMessage["$index.array"] ?? "Campo ({$modifyKey}) deve ser um array!",
            "$index.email"       => $customMessage["$index.email"] ?? "Campo ({$modifyKey}) deve ser um email!",
        ];
        return $return[$index.".".$type];
    }

    public static function modifyKey($index)
    {
        $return = [
            "email"      => "E-mail",
            "password"   => "Senha",
            "terms"      => "Termos",
        ];
        return $return[$index] ?? $index;
    }
}