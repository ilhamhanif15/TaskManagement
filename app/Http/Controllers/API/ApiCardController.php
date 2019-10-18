<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;


class ApiCardController extends Controller
{

    public function apiCardMove(Request $request)
    {
        $list_id = $request->input('list_id');
        return response()->json(['status' => 'success'], 200);
    }


}