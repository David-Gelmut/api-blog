<?php

namespace App\Http\Controllers\Archiv;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
  /*  public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    public function login(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required']
        ]);

        if (auth('web')->attempt($data)) {
            return redirect(route('home'));
        }

        return redirect(route('login'))->withErrors(['email' => 'User not find']);
    }


    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'string', 'unique:users,email'],
            'password' => ['required', 'confirmed']
        ]);

        $user = \App\Models\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if ($user) {
            auth('web')->login($user);
        }

        return redirect(route('home'));
    }

    public function logout(): RedirectResponse
    {
        auth('web')->logout();
        return redirect(route('home'));
    }

    public function showForgotForm(): View
    {
        return view('auth.forgot');
    }

    public function forgot(ForgotRequest $request): RedirectResponse
    {
        $password = uniqid();
        $data = $request->validated();
        $user = User::query()->where('email',$data['email'])->first();
        $user->password = bcrypt($password);
        $user->save();
        Mail::to($user)->send(new ForgotPasswordMailer($password));
        return redirect(route('home'));
    }*/
}
