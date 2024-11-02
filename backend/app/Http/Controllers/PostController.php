<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()
            ->orderBy('created_at', 'DESC')
            ->get();
         //   ->paginate(1);

        return view('posts.index', compact('posts'));
    }

    public function show($id): View
    {
        $post = Post::query()->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function comment($id, CommentRequest $request): RedirectResponse
    {
        $post = Post::query()->findOrFail($id);
        $post->comments()->create($request->validated());
        return redirect(route('posts.show', $id));
    }
}
