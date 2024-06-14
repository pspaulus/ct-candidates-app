<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

     /** Generar un JWT a partir de credenciales válidas */
     public function authenticate (Request $request): \Illuminate\Http\JsonResponse
     {
 
         $JWTAuth = JWTAuth::attempt(['email' => $request->email, 'password' => $request->password]);

        //  return dd($JWTAuth);
 
         if (!$JWTAuth) {
             return response()->json(["message" => 'Usuario o contraseña incorrecto!'], 400);
         }
 
         return response()
             ->json([ "id_token" => $JWTAuth ]);
 
    }

    public function register (Request $request): \Illuminate\Http\JsonResponse
    {

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);

 
         return response()
             ->json([ "message" => "usuario creado correctamente" ]);
    }

    /** Obtiene la información de un usuario a partir del JWT */
    public function account (): \Illuminate\Http\JsonResponse
    {

        $user = JWTAuth::toUser();


        return response()->json($user);
    }

    /** Cerrar sesión y destruir el JWT */
    public function logout (Request $request): \Illuminate\Http\JsonResponse
    {

        $token = $request->bearerToken();
        JWTAuth::invalidate($token);

        return response()
            ->json(['message' => 'Sesión eliminada correctamente!']);

    }

}