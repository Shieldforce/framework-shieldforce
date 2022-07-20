<?php

namespace App\Utils\SearchArray;

use App\Enuns\TypesInt;

class SearchArray
{
    // $type 0 não associativo e 1 associativo
    public static function where(string $searchValue, array $posts, TypesInt $type = TypesInt::ArrayAssociativeFalse, string $key = '')
    {

        $arrayNew = false;

        if ( $type == TypesInt::ArrayAssociativeFalse ) {
            $arrayNew = array_filter($posts, function ($value) use ($searchValue) {
                if (mb_strpos($value, $searchValue) !== false) {
                    return true;
                }
                return false;
            });
        }

        if ( $type == TypesInt::ArrayAssociativeTrue ) {
            foreach ($posts as $index => $p) {
                if(isset($p[$key])) {
                    if (mb_strpos($p[$key], $searchValue) !== false) {
                        $arrayNew[$index] = $p;
                    }
                }
            }
        }

        return $arrayNew;

    }
}