<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\PostFormRequest;
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

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostFormRequest $request)
    {
        $data = $request->validated();
        if ($request->has('prev_image')) {
            $prevPath = $request->file('prev_image')->store('posts', 'public');
            $data['prev_image'] = $prevPath;
        }
        $data['user_id'] = auth()->user()->id;
        $post = Post::create($data);

        return redirect(route('posts.index'));

    }
}
