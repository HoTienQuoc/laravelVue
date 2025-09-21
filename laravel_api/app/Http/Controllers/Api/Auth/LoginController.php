<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use Illuminate\Validation\ValidationException;

class LoginController extends BaseController
{
    /**
     * Create a new AuthController instance.
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['__invoke']]);
    }

    /**
     * Handle login and return JWT token and user info.
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        $validPassword = $user && Hash::check($request->password, $user->password);
        $token = $validPassword ? auth()->attempt($request->only('email', 'password')) : false;

        if (!$validPassword || !$token) {
            throw ValidationException::withMessages([
                'email' => ['The credentials you provided are incorrect.']
            ]);
        }

        return response()->json([
            'token' => $this->respondWithToken($token),
            'user' => auth()->user(),
        ], Response::HTTP_OK);
    }

    /**
     * Refresh a token.
     */
    public function refresh()
    {
        $success = $this->respondWithToken(auth()->refresh());

        return $this->sendResponse($success, 'Refresh token returned successfully.');
    }

    /**
     * Get the token array structure.
     */
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ];
    }
}
