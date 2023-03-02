<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{

    public function index() {
        try {
            $colors = Color::all();
            return response()->json($colors);
        } catch(\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function store(Request $request) {
        try {

            $validateColor = Validator::make($request->all(), [
                'name' => "required|string"
            ]);

            if ($validateColor->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateColor->errors()
                ], 404);
            }

            $color = new Color();
            $color->fill($request->post());
            $color->save();

            return response()->json([
                'id' => $color->id,
                'name' => $color->name
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function destory($id) {
        try {

            $color = Color::find($id);
            
            if (!$color) {
                return response()->json([
                    'status' => false,
                    'message' => 'Color not found',
                ], 404);
            }

            Color::destroy($id);

            return response()->json([
                    'id' => $color->id,
                    'name' => $color->name
                ], 200);

        } catch(\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    } 
}
