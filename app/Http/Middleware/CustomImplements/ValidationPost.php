<?php

namespace App\Http\Middleware\CustomImplements;


class ValidationPost
{
    /**
     * Responsable for execute is middleware
     * @param $request
     * @param $next
     */
    public function handle($request, $next)
    {
        self::replace($request);
        return $next($request);
    }

    private static function replace($request)
    {
        $arrayNewPostParams = [];
        foreach ($request->getPostParams() as $index => $value) {
            $arrayNewPostParams[$index] = self::captureTwoLevel($value);
        }
        $request->setPostParamsSanitize($arrayNewPostParams);
    }

    private static function captureTwoLevel($valueOrArray)
    {
        if(is_array($valueOrArray)) {
            foreach ($valueOrArray as $index => $v) {
                $v = self::sanitize($v);
                $valueOrArray[$index] = $v;
            }
            return $valueOrArray;
        }
        return self::sanitize($valueOrArray);
    }

    private static function sanitize($value)
    {
        if(!is_array($value)) {
            $value = trim($value);
            $value = filter_var($value,FILTER_SANITIZE_ADD_SLASHES);
        }
        return $value;
    }
}