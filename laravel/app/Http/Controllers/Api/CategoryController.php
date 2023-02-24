<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function show($id) {
        try {

            $category = Category::find($id);
            
            if (!$category) {
                return response()->json([
                    'status' => false,
                    'message' => 'Category not found',
                ], 404);
            }

            return response()->json([
                'id' => $category->id,
                'name' => $category->name,
                'image' => $category->image
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getProductsByCategoryId($id) {
        try {

            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'status' => false,
                    'message' => 'Category not found',
                ], 404);
            }

            $products = Product::with('category', 'color')->where('category_id', $id)->get();

            return response()->json($products, 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function store(Request $request) {
        try {

            $validateCategory = Validator::make($request->all(), [
                'name' => "required|alpha_num",
                'image' => "required|image|mimes:jpj,png,jpeg,gif,svg|max:2048"
            ]);

            if ($validateCategory->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateCategory->errors()
                ], 404);
            }

            $image_path = $request->file('image')->store('image', 'public');
            $category = Category::create([
                'name' => $request->name,
                'image' => $image_path
            ]);

            return response()->json([
                'id' => $category->id,
                'name' => $category->name,
                'image' => $category->image
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $validateCategory = Validator::make($request->all(), [
                'name' => "required|alpha_num",
                'image' => "image|mimes:jpj,png,jpeg,gif,svg|max:2048"
            ]);

            if ($validateCategory->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateCategory->errors()
                ], 404);
            }

            $category = Category::find($id);
            
            if (!$category) {
                return response()->json([
                    'status' => false,
                    'message' => 'Category not found',
                ], 404);
            }
            
            $category['name'] = $request->name;

            if ($request->file('image')) {
                $image_path = $request->file('image')->store('image', 'public');
                $category['image'] = $image_path;
            }

            $category->save();

            return response()->json([
                'id' => $category->id,
                'name' => $category->name,
                'image' => $category->image
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

            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'status' => false,
                    'message' => 'Category not found',
                ], 404);
            }

            Category::destroy($id);

            return response()->json([
                'id' => $category->id,
                'name' => $category->name,
                'image' => $category->image
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
