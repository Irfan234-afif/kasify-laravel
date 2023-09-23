<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(LoginRequest $request)
    {
        $request->validated();

        $user = User::whereEmail($request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Invalid credential',
            ], 404);
        } else {
            $token = $user->createToken($user->name)->plainTextToken;
            return response(
                [
                    'meta' => $user,
                    'token' => $token,
                ],
                200
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response([
            'message' => 'succes',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(RegisterRequest $request)
    {
        $request->validated();

        $data = [
            'name' => $request->name,
            'shop_name' => $request->shop_name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        $user = User::create($data);

        $token = $user->createToken($request->name)->plainTextToken;

        return response(
            [
                'meta' => $user,
                'token' => $token,
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}