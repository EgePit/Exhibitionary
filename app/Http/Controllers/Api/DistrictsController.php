<?php

namespace App\Http\Controllers\Api;

use App\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictsController extends Controller
{
    public function get_by_city(Request $request) {
        try {
            $districts = District::where('city_id', $request['city_id'])->get();

            return response()->json([
                    'status' => 'success',
                    'data' => $districts
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
