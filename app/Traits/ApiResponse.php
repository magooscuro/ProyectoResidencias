<?php

namespace App\Traits;

/**
 *En este atchivo manejamos los errores y los enviamos en formato json
 */
trait ApiResponse
{
    public function successResponse($data,$code = 200,$msj='si jala perro'){

        return response()->json(array("data" => $data ,"code" =>$code, "msj" =>$msj ),$code);
    }

    public function errorResponse($data,$code = 500,$msj=''){

        return response()->json(array("data" => $data ,"code" =>$code, "msj" =>$msj ),$code);
    }
}
