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
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use SebastianBergmann\CodeCoverage\Util\Percentage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->join('users','posts.user_id','=','users.id')
            ->join('categories','posts.category_id','=','categories.id')
            ->select([
                'posts.created_at','posts.id','posts.prev_image','posts.preview','posts.title','posts.description',
                'categories.title as category_title',
                'users.name','users.id as user_id'
            ])
            ->orderBy('created_at', 'DESC')
            ->get();
        return
            response()->json([
                'posts'=>  PostResource::collection($posts)
            ]);
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
        $data['user_id'] =auth()->user()->id;
        Post::create($data);

        return response($data);
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
