<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "image" => "required",
            "price" => "required",
            "description" => "required",
            "discount" => "required",
            "category_id" => "required",
            "color_id" => "required"
        ]);

        if ($validator->fails()) {
            return "Please enter the required fields";
        }

        $product = new Product();

        $image_path = $request->file('image')->store('image', 'public');
        $product = Product::create([
            "name" => $request->name,
            "image" => $image_path,
            "price" => $request->price,
            "description" => $request->description,
            "discount" => $request->discount,
            "category_id" => $request->category_id,
            "color_id" => $request->color_id
        ]);

        return response()->json([
            "name" => $product->name,
            "image" => $product->image,
            "created category successfully !
            "
        ]);
    }

    function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if (!$product) {
            return response()->json('failed to update');
        }

        $image_path = $request->file('image')->store('image', 'public');

        $product->fill($request->all());
        $product['image'] = $image_path;
        $product->save();
        return response()->json('updated successfully');
    }

    function delete($id)
    {
        return Product::destroy($id);
    }
}