<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Services\AdminPostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        $posts = Post::with(['user', 'category'])
            ->orderBy('created_at', 'DESC')
            ->get();
        //Оставил комментарий для примера варианта выборки
        /* $posts = Post::query()
            ->join('users','posts.user_id','=','users.id')
            ->join('categories','posts.category_id','=','categories.id')
            ->select([
                'posts.created_at','posts.id','posts.prev_image','posts.preview','posts.title','posts.description',
                'categories.title as category_title',
                'users.name','users.id as user_id'
            ])
            ->orderBy('created_at', 'DESC')
            ->get();*/
        return
            response()->json([
                'posts'=>  PostResource::collection($posts),
            ]);
    }

    public function authPosts(): JsonResponse
    {

        $posts = Post::with(['user', 'category'])
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();
        return
            response()->json([
                'posts' => PostResource::collection($posts)
            ]);
    }

    public function show(Post $post): JsonResponse
    {
        return
            response()->json([
                'post' => new PostResource($post->load(['comments']))
            ]);

    }

    public function update(\App\Http\Requests\Api\PostFormEditRequest $request, Post $post): JsonResponse
    {
        $data = $request->validated();
        $post->update($data);
        return response()->json([
            'msg' => 'Пост обновлен',
        ]);
    }

    public function store(\App\Http\Requests\Api\PostFormRequest $request, AdminPostService $service): JsonResponse
    {
        $data = $request->validated();
        $data = $service->getPathPrevImage($request, $data);
        $data['user_id'] = auth()->user()->id;
        $post = Post::create($data);
        return
            response()->json([
                'msg' => 'Пост создан',
                'post' => new PostResource($post)
            ]);
    }

    public function delete(Post $post): JsonResponse
    {
        $post->delete();
        response()->json([
            'msg' => 'Пост удалён'
        ]);
    }

    public function comment($id, CommentRequest $request): RedirectResponse
    {
        $post = Post::query()->findOrFail($id);
        $post->comments()->create($request->validated());
        return redirect(route('posts.show', $id));
    }

}
