<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PostFormRequest;
use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\Api\UserStoreRequest;
use App\Http\Requests\ForgotRequest;
use App\Http\Resources\User\UserResource;
use App\Mail\ForgotPasswordMailer;
use App\Models\Enums\Roles;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register(UserStoreRequest $request): void
    {
        $data = $request->validated();
        User::create($data);
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        if(auth()->check()){
            return response()->json([
                'user' =>auth()->user(),
            ]);
        }
        $data = $request->validated();
        if (!Auth::attempt($data)) {

            return response()->json([
                'message' => 'Ошибка авторизации.Проверьте правильность введенных данных'
            ], 401);
        }
        $user = User::query()->where('email', $data['email'])->first();
       // $user->tokens()->delete();
      //  $token = $user->createToken('auth_token')->plainTextToken;
        $request->session()->regenerate();
        return response()->json([
            'user' => $user,
          //  'token' => $token,
            'role' => $user->role,
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $user = Auth::user();
        auth()->logout();
    //    $user->tokens()->delete();
        $request->session()->invalidate();

     //   $request->session()->regenerateToken();
        return response()->json([
            'message' => 'Пользователь разлогинился',
            'user' => $user
        ]);
    }

    public function forgot(ForgotRequest $request): JsonResponse
    {
        $password = uniqid();
        $data = $request->validated();
        $user = User::query()->where('email', $data['email'])->first();
        $user->password = bcrypt($password);
        $user->save();
        Mail::to($user)->send(new ForgotPasswordMailer($password));
        return response()->json([
            'message' => 'Новый пароль отправлен на почту'
        ]);
    }

}
