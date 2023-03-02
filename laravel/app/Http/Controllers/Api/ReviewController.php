<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index() {
        try {
            $reviews = Review::with('user', 'product')->paginate(9);
            return response()->json($reviews);
        } catch(\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        try {

            $review = Review::with('user', 'product')->find($id);

            if (!$review) {
                return response()->json([
                    'status' => false,
                    'message' => 'Review not found',
                ], 404);
            }

            return response()->json($review, 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    

    public function store(Request $request) {
        try {

            $validateReview = Validator::make($request->all(), [
                'user_id' => 'required|numeric',
                'product_id' => 'required|numeric',
                'rating' => 'required|numeric|min:0|max:5',
                'description' => 'required|string'
            ]);

            if ($validateReview->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateReview->errors()
                ], 404);
            }

            $review = Review::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'rating' => $request->rating,
                'description' => $request->description
            ]);

            return response()->json($review, 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $reviewId) {
        try {

            $validateReview = Validator::make($request->all(), [
                'user_id' => 'required|numeric',
                'product_id' => 'required|numeric',
                'rating' => 'required|numeric|min:0|max:5',
                'description' => 'required|string'
            ]);

            if ($validateReview->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateReview->errors()
                ], 404);
            }

            $review = Review::with('user', 'product')->find($reviewId);

            if (!$review) {
                return response()->json([
                    'status' => false,
                    'message' => 'Review not found',
                ], 404);
            }

            $review->fill($request->post());
            $review->save();

            return response()->json($review, 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function destory($id) {
        try {

            $review = Review::with('user', 'product')->find($id);

            if (!$review) {
                return response()->json([
                    'status' => false,
                    'message' => 'Review not found',
                ], 404);
            }

            Review::destroy($id);

            return response()->json($review, 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
