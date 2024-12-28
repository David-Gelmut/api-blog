<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostFormRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{

    public function __construct() {
        $this->authorizeResource(Post::class, 'post');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = Post::query()->orderBy('created_at', 'DESC')->paginate();

      //  $posts = Post::paginate(1);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostFormRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if ($request->has('prev_image')) {
            $prevPath = $request->file('prev_image')->store('posts', 'public');
            $data['prev_image'] = $prevPath;
        }
        // $tagsIds = $data['tags'];
        // unset($data['tags']);
        $data['user_id'] = auth()->user()->id;
        $post = Post::create($data);
        if ($data['tags']) {
            $post->tags()->attach($data['tags']);
        }

        return redirect(route('admin.posts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostFormRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();
        if ($request->has('prev_image')) {
            $prevPath = $request->file('prev_image')->store('posts', 'public');
            $data['prev_image'] = $prevPath;
        }
        $post->update($data);
        if ($data['tags']) {
            $post->tags()->sync($data['tags']);
        }

        return redirect(route('admin.posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return redirect(route('admin.posts.index'));
    }
}
