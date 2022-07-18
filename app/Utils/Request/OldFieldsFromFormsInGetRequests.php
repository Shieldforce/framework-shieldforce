<?php

namespace App\Utils\Request;

class OldFieldsFromFormsInGetRequests
{
    public static function remove($content)
    {
        //--------------------------------------------------------------------------------------------------------------
        //-Remove oldFields from forms in GET requests
        if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"]=="GET") {
            $content = preg_replace_callback_array([
                '/{{oldFields::.*}}/' => function ($matches) { return ""; }
            ], $content);
        }
        //--------------------------------------------------------------------------------------------------------------
        return $content;
    }

    public static function add($args)
    {
        //--------------------------------------------------------------------------------------------------------------
        //-Add form oldFields in POST requests
        $arrayFields = [];
        if($args["getPostParams"] && isset($_SESSION["old_fields"]) && is_array($_SESSION["old_fields"])) {
            foreach ($_SESSION["old_fields"] as $index => $field) {
                $arrayFields["oldFields::".$index] = $field;
            }
        }
        //--------------------------------------------------------------------------------------------------------------
        return $arrayFields;
    }
}