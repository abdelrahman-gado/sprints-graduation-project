<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $orders = Order::with('user', 'orderDetails')->paginate(9);
            return response()->json($orders, 200);
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

            $order = Order::with('user', 'orderDetails')->find($id);

            if (!$order) {
                return response()->json([
                    'status' => false,
                    'message' => 'Order not found',
                ], 404);
            }

            return response()->json($order, 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getOrderDetailsByOrderId($id)
    {
        try {

            $order = Order::find($id);

            if (!$order) {
                return response()->json([
                    'status' => false,
                    'message' => 'Order not found',
                ], 404);
            }

            $orderDetails = Order_Detail::with('product', 'order')->where('order_id', $id)->get();

            return response()->json($orderDetails, 200);

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

            $validateOrder = Validator::make($request->all(), [
                'user_id' => 'required|numeric',
                'shipping_price' => 'required|numeric',
                'total_price' => 'required|numeric',
                'order_details' => 'required|array',
                'order_details.*.product_id' => 'required|numeric',
                'order_details.*.price' => 'required|numeric',
                'order_details.*.quantity' => 'required|numeric',
                'order_details.*.subTotalPrice' => 'required|numeric'
            ]);


            if ($validateOrder->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateOrder->errors()
                ], 404);
            }


            $order = Order::create([
                "user_id" => $request->user_id,
                "shipping_price" => $request->shipping_price,
                "total_price" => $request->total_price,
            ]);

            $orderDetails = $request->order_details;
            
            foreach ($orderDetails as $orderDetail) {
                $orderItem = Order_Detail::create([
                    "order_id" => $order->id,
                    "product_id" => $orderDetail["product_id"],
                    "price" => $orderDetail["price"],
                    "quantity" => $orderDetail["quantity"],
                    "subTotalPrice" => $orderDetail["subTotalPrice"]
                ]);
            }

            return response()->json([
                "status" => true,
                "message" => "The order is submitted successfully"
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

            $order = Order::find($id);

            if (!$order) {
                return response()->json([
                    'status' => false,
                    'message' => 'Order not found',
                ], 404);
            }

            Order::destroy($id);

            return response()->json($order, 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
