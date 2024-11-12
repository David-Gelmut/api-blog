<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostFormRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use SebastianBergmann\CodeCoverage\Util\Percentage;

class PostController extends Controller
{
    public function index():AnonymousResourceCollection
    {
        $posts = Post::query()
            ->orderBy('created_at', 'DESC')
            ->get();
        return PostResource::collection($posts);
    }

    public function show(Post $post):PostResource
    {
        return new PostResource($post) ;
    }

    public function comment($id, CommentRequest $request): RedirectResponse
    {
        $post = Post::query()->findOrFail($id);
        $post->comments()->create($request->validated());
        return redirect(route('posts.show', $id));
    }


    public function store(\App\Http\Requests\Api\PostFormRequest $request)
    {
        $data = $request->validated();
        if ($request->has('prev_image')) {
            $prevPath = $request->file('prev_image')->store('posts', 'public');
            $data['prev_image'] = $prevPath;
        }
       // $data['prev_image'] = 'test/path/image.jpg';
        //$data['user_id'] = auth()->user()->id;
        $data['user_id'] =1;
        Post::create($data);

        return response([]);
    }

    public function update(\App\Http\Requests\Api\PostFormEditRequest $request,Post $post)
    {
        $data = $request->validated();
      ///  if ($request->has('prev_image')) {
        //    $prevPath = $request->file('prev_image')->store('posts', 'public');
        //    $data['prev_image'] = $prevPath;
     //   }
        //$data['user_id'] =1;
        $post->update($data);
        return response([]);
    }

    public function delete(Post $post)
    {
        $post->delete();
        return response([]);
    }
}
