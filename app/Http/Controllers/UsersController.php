<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class UsersController extends Controller
{
    //

    public function users(Request $request)
    {

        if ($request->has('active')) {
            $users = User::where('active', true)->get();
        } else {
            $users = User::all();
        }


        return response()->json($users);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['status' => 0, 'msg' => 'Invalid login details'], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Hi'.$user->name,
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
        
    }
    
    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
    
        return response()->json(['status' => 1, 'msg' => 'Tokens deleted successfully'], 200);
    }
    

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'msg' => $validator->errors()], 400);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'active' => true,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('auth_toke')->plainTextToken;
        return response()->json(['data' => $user, 'token_type' => 'Bearer', 'token' => $token]);
    }
}
