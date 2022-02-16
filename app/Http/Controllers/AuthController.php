<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\AuthResource;
use App\Services\Contracts\AuthServiceContract;
use Auth;
use Exception;

class AuthController extends Controller
{
    public function __construct(protected AuthServiceContract $authService)
    {
    }

    public function login(AuthRequest $request)
    {
        $input = $request->only('email', 'password');

        if (!Auth::attempt($input)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        return new AuthResource(auth()->user());
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        
        return response()->json('Ok', 200);
    }

    public function signup(SignupRequest $request)
    {

        $input = $request->only('name', 'email', 'password');

        try {
            $user = $this->authService->create($input);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Falha. Tente novamente.'
            ], $e->getCode());
        }

        return new AuthResource($user);
    }
}
