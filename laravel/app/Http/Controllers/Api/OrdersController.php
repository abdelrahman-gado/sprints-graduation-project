<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    function getOrders($orderId){
        $details = OrderDetail::where('order_id',$orderId)->get();
        $orders = Order::with('user')->where('id',$orderId)->get();
        return response()->json([$orders,$details]);
    }

    function create(Request $request){
        $validator = Validator::make($request->all(), [
            "user_id" => "required",
            "shipping_price" => "required"        
        ]);

        if ($validator->fails()) {
            return "Please enter the required fields";
        }

        $order = new Order();
        $order = Order::create([
            "user_id" => $request->user_id,
            "shipping_price" => $request->shipping_price,
        ]);
        $order->save();

        return response()->json('order created');
    }

    function update(Request $request, $id){
        $validate = Validator::make($request->all(), [
            'user_id'=>'required',
            'shipping_price'=>'required'
        ]);

        if($validate->fails()){
            return response()->json('Please fill the required fields !');
        }
        // $product is to get the choosen product and use its sub total price
        $details = OrderDetail::where('order_id',$id)->get();
        $sub = 0;
        foreach($details as $detail){
            $sub += $detail['subTotalPrice'];
        }

        $order = Order::find($id);
        $order->fill($request->all());
        $order['total_price'] = $order['shipping_price'] + $sub;
        $order->save();

        return response()->json('updated this order !');
    }

    function delete($id)
    {
        return Order::destroy($id);
    }
}
