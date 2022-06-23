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

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.'
            ],
                500);
        }

        return response()->json([
            'data'    => [
                'user'  => $user,
                'token' => $user->createToken($request->email)->plainTextToken,
            ],
            'message' => 'Logged in successfully'
        ],
            200);
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

        return response()->json([
            'data'    => [
                'user'  => $user,
                'token' => $user->createToken($request->email)->plainTextToken,
            ],
            'message' => 'Successfully registered'
        ],
            Response::HTTP_CREATED);
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'data'    => null,
            'message' => 'Logged out'
        ],
            200);
    }
}
