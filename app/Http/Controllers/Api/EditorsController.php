<?php

namespace App\Http\Controllers\Api;

use App\Editor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class EditorsController extends Controller
{
    public function get_by_city(Request $request) {
        try {
            $editors = Editor::whereHas('cities', function($q) use ($request){
                $q->where('city_id', '=', $request['city_id']);
            })->get();

            return response()->json([
                    'status' => 'success',
                    'data' => $editors
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
