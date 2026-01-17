<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use PhpParser\Node\Stmt\TryCatch;

class AuthController extends Controller
{
    public function login(Request $request){
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if(!Auth::attempt($credentials)){
            return response()->json(["message" =>"Unauthorized"], 401);
        }
        
        $token =$request->user()->createToken("auth_token")->plainTextToken;
        return response()->json(["access_token" =>$token, "token_type" => "Bearer"]);
    }

    public function register(Request $request){
        $credentials = $request->validate([
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required"
        ]);

        try {
            User::create([
                "name" => $credentials["name"],
                "email" =>  $credentials["email"],
                "password" =>  bcrypt($credentials["password"]),
            ]);
        } catch (\Throwable $th) {
            return response()->json(["error" => $th->getMessage()]);
        }
        return response()->json(["message" => "Creado correctamente"]);

    }

    public function user(Request $request){
        return response()->json($request->user());
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(["message" => "Logged out"]);
    }
}
