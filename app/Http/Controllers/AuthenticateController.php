<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticateController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'response' => true,
            'message' => 'El usuario ha sido registrado correctamente, ¡Exito!',
            'status' => Response::HTTP_CREATED,
        ],  Response::HTTP_CREATED);
    }

    public function login(LoginUserRequest $request)
    {
        $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'message' => ['Las credenciales ingresadas son incorrectas, por favor verifica tu correo y contraseña, !Error¡.'],
                ]);
            }

        $user->createToken($request->email);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'response' => true,
            'message' => ['La sesion ha finalizada cerrada correctamente, !Exito¡.'],
        ], Response::HTTP_OK);
    }

}
