<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        if(auth()->check()){
            $posts = Post::query()->orderBy('created_at', 'DESC')->get();
            return \view('admin.posts.index',compact('posts'));
        }
        return view('admin.auth.login');
    }

    public function login_process(LoginRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if (auth()->attempt($data)) {
            return redirect(route('admin.posts.index'));
        }

        return redirect(route('admin.login'))->withErrors(['email' => 'User not find']);
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect(route('admin.login'));
    }
}
