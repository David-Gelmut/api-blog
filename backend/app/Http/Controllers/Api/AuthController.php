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
    public function register(UserStoreRequest $request):JsonResponse
    {
        $user  = User::create($request->validated());
        Auth::login($user);
        return response()->json([
            'msg'=>'Пользователь зарегистрирован',
            'user' => $user,
        ]);
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        if (!Auth::attempt($data)) {
            return response()->json([
                'message' => 'Ошибка авторизации.Проверьте правильность введенных данных'
            ], 401);
        } else {
            $request->session()->regenerate();
            return response()->json([
                'msg'=>'Пользователь авторизован',
                'user' => $request->user(),
            ]);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $user = Auth::user();
        auth()->logout();
        $request->session()->invalidate();
        return response()->json([
            'message' => 'Пользователь разлогинился',
            'user' => $user
        ]);
    }

    public function forgot(ForgotRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::query()->where('email', $data['email'])->first();
        $password = uniqid();
        $user->password = bcrypt($password);
        $user->save();
        Mail::to($user)->send(new ForgotPasswordMailer($password));
        return response()->json([
            'message' => 'Новый пароль отправлен на почту'
        ]);
    }

}
