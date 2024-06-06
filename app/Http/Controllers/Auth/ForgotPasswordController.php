<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    // Muestra el formulario para solicitar el restablecimiento de contraseña
    public function showLinkRequestForm()
    {
        return view('auth.password_reset');
    }

    // Envía el enlace de restablecimiento de contraseña al correo electrónico proporcionado
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Envía el correo electrónico de restablecimiento de contraseña
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
