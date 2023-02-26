<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    function index(){
        $categories = Category::all();
        return response()->json($categories);
    }

    function store(Request $request){
        $validator = Validator::make($request->all(),[
            "name"=>"required",
            "image"=>"required"
        ]);

        if($validator->fails()){
            return "Please enter the required fields";
        }

        $category = new Category();
        $category->fill($request->all());
        $category->save();

        return response()->json([
            "name"=>$category->name,
            "image"=>$category->image,
            "created category successfully !
            "]);
    }

    function delete($id){
        return Category::destroy($id);
    }
}
