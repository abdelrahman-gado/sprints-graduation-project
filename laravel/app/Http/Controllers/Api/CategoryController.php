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
        try {
            $categories = Category::paginate(9);
            return response()->json($categories);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
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

            $products = Product::with('category', 'color', 'reviews')
                    ->withCount('reviews')
                    ->withAvg('reviews', 'rating')->where('category_id', $id)->get();

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
                'name' => "required|string",
                'image' => "required|image|mimes:jpj,png,jpeg,gif,svg|max:2048"
            ]);

            if ($validateCategory->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateCategory->errors()
                ], 404);
            }

            // store full url of the image in image_path ex: $image_path = 'http://localhost:8000/storage/image/23423.jpg'
            $image_url = url('/storage/' . $request->file('image')->store('image', 'public'));
            $category = Category::create([
                'name' => $request->name,
                'image' => $image_url
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
                'name' => "required|string",
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
                $image_url =  url('/storage/' . $request->file('image')->store('image', 'public'));
                $category['image'] = $image_url;
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
