<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    function getUsers(){
        $users = User::all();
        return response()->json(@$users);
    }

    public function createUser(Request $request)
    {

        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required',
                    'phone'=>'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone'=>$request->phone
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone'=> $user->phone,
                'token' => $user->createToken('API TOKEN')->plainTextToken
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
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


    public function loginUser(Request $request) {
        try {

            $validateUser = validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }
            
            $user = User::Where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch(\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}