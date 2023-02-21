<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{

    public function index() {
        $colors = Color::all();
        return response()->json($colors);
    }

    public function store(Request $request) {
        try {

            $validateColor = Validator::make($request->all(), [
                'name' => "required|alpha_num"
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

}
