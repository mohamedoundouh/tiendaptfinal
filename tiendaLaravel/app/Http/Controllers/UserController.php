<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'nick' => $request->nick,
            'email' => $request->email,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'dni' => $request->dni,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'password' => bcrypt($request->password),
            'rol' => $request->rol,
        ]);

        return back()->with('success', 'Usuario creado correctamente.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->with('success', 'Acceso correcto.');
        }

        return back()->with('error', 'Credenciales inválidas.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Has cerrado sesión correctamente.');
    }
}