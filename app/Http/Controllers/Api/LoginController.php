<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Método para manejar el inicio de sesión
    public function login(Request $request)
    {
        // Validar los datos de inicio de sesión
        $this->validateLogin($request);

        // Intentar autenticar al usuario
        if (Auth::attempt($request->only('email','password'))) {
            // Si la autenticación es exitosa, generar un token para el usuario
            return response()->json([
                'token' => $request->user()->createToken($request->name)->plainTextToken, // Generar token
                'message' => 'Success' // Mensaje de éxito
            ]);
        }

        // Si la autenticación falla, devolver una respuesta de error
        return response()->json([
            'message' => 'Unauthorized' // Mensaje de error de autorización
        ], 401); // Código de estado HTTP 401 para no autorizado
    }

    // Método para validar los datos de inicio de sesión
    public function validateLogin(Request $request)
    {
        // Validar los campos de email, contraseña y nombre
        return $request->validate([
            'email' => 'required|email', // Campo de correo electrónico requerido y debe ser un correo electrónico válido
            'password' => 'required', // Campo de contraseña requerido
            'name' => 'required' // Campo de nombre requerido
        ]);
    }
}
