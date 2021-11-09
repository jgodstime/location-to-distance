<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success($data, $statusCode = 200)
    {
        return response()->json([
            'status' => "success",
            'data' => $data,

        ], $statusCode);


    }


    public function error($data, $statusCode = 422)
    {
        return response()->json([
            'status' => "error",
            'data' => $data,

        ], $statusCode);

    }
}
