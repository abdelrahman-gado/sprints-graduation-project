<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::with('category', 'color', 'reviews')->get();
            return response()->json($products);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {

            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found',
                ], 404);
            }

            return response()->json([
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'description' => $product->description,
                'discount' => $product->discount,
                'category' => [
                    'id' => $product->category->id,
                    'name' => $product->category->name,
                    'image' => $product->category->image,
                ],
                'color' => [
                    'id' => $product->color->id,
                    'name' => $product->color->name
                ],
                'review' => $product->reviews,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getReviewsByProductId($productId)
    {
        try {

            $product = Product::find($productId);

            if (!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found',
                ], 404);
            }

            $reviews = Review::with('user', 'product')->where('product_id', $productId)->get();

            return response()->json($reviews, 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function store(Request $request)
    {
        try {

            $validateProduct = Validator::make($request->all(), [
                'name' => 'required',
                'image' => 'required|image|mimes:jpj,png,jpeg,gif,svg|max:2048',
                'price' => 'required|numeric',
                'description' => 'required|String',
                'discount' => 'required|numeric',
                'category_id' => 'required|numeric',
                'color_id' => 'required|numeric'
            ]);

            if ($validateProduct->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateProduct->errors()
                ], 404);
            }

            $image_path = $request->file('image')->store('image', 'public');
            $product = Product::create([
                'name' => $request->name,
                'image' => $image_path,
                'price' => $request->price,
                'description' => $request->description,
                'discount' => $request->discount,
                'category_id' => $request->category_id,
                'color_id' => $request->color_id,
            ]);

            return response()->json([
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'description' => $product->description,
                'discount' => $product->discount,
                'category' => [
                    'id' => $product->category->id,
                    'name' => $product->category->name,
                    'image' => $product->category->image,
                ],
                'color' => [
                    'id' => $product->color->id,
                    'name' => $product->color->name
                ],
                'reviews' => [],
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validateProduct = Validator::make($request->all(), [
                'name' => 'required',
                'image' => 'image|mimes:jpj,png,jpeg,gif,svg|max:2048',
                'price' => 'required|numeric',
                'description' => 'required|String',
                'discount' => 'required|numeric',
                'category_id' => 'required|numeric',
                'color_id' => 'required|numeric'
            ]);

            if ($validateProduct->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateProduct->errors()
                ], 404);
            }

            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found',
                ], 404);
            }

            $product->fill($request->post());

            if ($request->file('image')) {
                $image_path = $request->file('image')->store('image', 'public');
                $product['image'] = $image_path;
            }

            $product->save();

            return response()->json([
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'description' => $product->description,
                'discount' => $product->discount,
                'category' => [
                    'id' => $product->category->id,
                    'name' => $product->category->name,
                    'image' => $product->category->image,
                ],
                'color' => [
                    'id' => $product->color->id,
                    'name' => $product->color->name
                ],
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destory($id)
    {
        try {

            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found',
                ], 404);
            }

            Product::destroy($id);

            return response()->json([
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'description' => $product->description,
                'discount' => $product->discount,
                'category' => [
                    'id' => $product->category->id,
                    'name' => $product->category->name,
                    'image' => $product->category->image,
                ],
                'color' => [
                    'id' => $product->color->id,
                    'name' => $product->color->name
                ],
                'reviews' => $product->reviews,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
