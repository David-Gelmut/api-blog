<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PostFormRequest;
use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\Api\UserStoreRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(UserStoreRequest $request)
    {
        $data = $request->validated();
        User::create($data);
    }

    public function login(UserLoginRequest $request)
    {
        $data = $request->validated();
        if (!Auth::attempt($data)) {
            return response()->json([
                'message' => 'Пользователь не авторизован'
            ], 401);
        }
        $user = Auth::user();
        return new UserResource($user);
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return response()->json([
            'message' => 'Пользователь разлогинился'
        ]);
    }
}
