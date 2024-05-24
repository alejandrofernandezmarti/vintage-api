<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AlumnoResource;
use App\Http\Resources\EmpresaResource;
use App\Http\Resources\ResponsableResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return new UserCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $validatedData['email'],
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'password' => bcrypt($validatedData['password']),
            'admin' => 0,
        ]);

        // Mail::to($user->email)->send(new RegisterConfirmationMail($user));
        return response()->json(['user' => $user], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);

    }

    /**
     * Update the specified resource in storage.
     */
    public function getInfo(){
        $user = Auth::user();
        return new UserResource($user);
    }
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json($user, 203,'User deleted');
    }
}
