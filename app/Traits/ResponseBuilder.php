<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;

trait ResponseBuilder
{
    /**
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return Symfony\Component\HttpFoundation\JsonResponse
     */
    public static function success(mixed $data=null,string $message="OK",int $code=200) :JsonResponse
    {
        return response()->json([
            'success'=>true,
            'data'=>$data,
            'message'=>$message
        ],$code);
    }
    /**
     * @param string $message
     * @param int $code
     * @return Symfony\Component\HttpFoundation\JsonResponse
     */
    public static function error(string $message="ERROR !",int $code=500) :JsonResponse
    {
        return response()->json([
            'success'=>false,
            'message'=>$message
        ],$code);
    }
}
