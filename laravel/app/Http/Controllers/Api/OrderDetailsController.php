<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderDetailsController extends Controller
{
    function getOrderDetails(){
        $details = OrderDetail::with('product')->get();
        return response()->json($details);
    }

    function create(Request $request){
        $validate = Validator::make($request->all(), [
            'order_id'=>'required',
            'product_id'=>'required',
            'quantity'=>'required'
        ]);

        if($validate->fails()){
            return response()->json('Please fill the required fields !');
        }
        // $product is to get the choosen product and use its price
        $product = Product::find($request->product_id);
        
        $detail = new OrderDetail();
        $detail = OrderDetail::create([
            'order_id'=>$request->order_id,
            'product_id'=>$request->product_id,
            'price'=>$product['price'],
            'quantity'=>$request->quantity,
            'subTotalPrice'=>($request->quantity * $product['price'])
        ]);
        return response()->json('added to order');
    }

    function update(Request $request, $id){
        $validate = Validator::make($request->all(), [
            'product_id'=>'required',
            'quantity'=>'required'
        ]);

        if($validate->fails()){
            return response()->json('Please fill the required fields !');
        }
        // $product is to get the choosen product and use its price
        $product = Product::find($request->product_id);

        $detail = OrderDetail::find($id);
        $detail->fill($request->all());
        $detail['id'] = $id;
        $detail['price'] = $product['price'];
        $detail['subTotalPrice'] = $detail['price'] * $detail['quantity'];
        $detail->save();

        return response()->json('updated this detail !');
    }

    function delete($id){
        $detail = OrderDetail::destroy($id);
        return response('Detail has been deleted');
    }
}
