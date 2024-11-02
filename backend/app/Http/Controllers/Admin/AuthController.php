<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('admin.auth.login');
    }

    public function login_process(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required']
        ]);

        if (auth('admin')->attempt($data)) {
            return redirect(route('admin.posts.index'));
        }

        return redirect(route('admin.login'))->withErrors(['email' => 'User not find']);
    }

    public function logout(): RedirectResponse
    {
        auth('admin')->logout();
        return redirect(route('admin.login'));
    }
}
