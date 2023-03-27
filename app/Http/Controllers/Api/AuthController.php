<?php

namespace App\Http\Controllers\Api;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiBaseController
{
    use PasswordValidationRules;

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password) || $user->isVendor()) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.'
            ],
                500);
        }

        return $this->sendResponse([
            'user'  => $user,
            'token' => $user->createToken($request->email)->plainTextToken,
        ], 'Logged in successfully');
    }


    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name'                  => 'required',
            'email'                 => 'email|required|unique:users,email',
            'password'              => $this->passwordRules(),
            'password_confirmation' => 'required',
            'mobile'                => 'digits:10|required|unique:users,mobile'
        ]);
        $request->merge([
            'password' => Hash::make($request->password),
        ]);
        $user = User::create($request->all());

        return $this->sendResponse([
            'user'  => $user,
            'token' => $user->createToken($request->email)->plainTextToken,
        ], 'Registered Successfully', Response::HTTP_CREATED);
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->sendResponse(null, 'Logout Successfully', 200);
    }
}
