<?php

namespace App\Http\Controllers\Api;

use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CitiesController extends Controller
{
    public function get_list() {
        try {
            $cities = City::all();

            return response()->json([
                'status' => 'success',
                'data' => $cities
            ], 200
            );
        } catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => ['message' => 'Something went wrong!']
            ], 500
            );
        }
    }
}
