<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class UserContoller extends Controller
{

    public function index() {

    }

    public function getReviewsByUserId($userId)
    {
        try {

            $user = User::find($userId);

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found',
                ], 404);
            }

            $reviews = Review::with('user', 'product')->where('user_id', $userId)->get();

            return response()->json($reviews, 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    function getUsers(){
        $users = User::all();
        return response()->json(@$users);
    }

    function updateUsers(Request $request,$id){
        $user = User::find($id);
        if(!$user){
            return response()->json('no such user !');
        }
        $user->fill($request->all());
        $user->save();
        return response()->json("successfully updated");
    }

}
