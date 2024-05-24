<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    /**
     * @OA\Post(
     *      path="/api/login",
     *      tags={"Login"},
     *      summary="Login",
     *      description="Hacer login",
     *           @OA\Response(
     *           response=200,
     *           description="Successful operation",
     *           @OA\JsonContent()
     *       )
     *     )
     */
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('api-token')->plainTextToken;

        return $token;
    }

}
