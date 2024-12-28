<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostFormRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use SebastianBergmann\CodeCoverage\Util\Percentage;

class CommentController extends Controller
{
    public function index($post_id)
    {
        $comments = Comment::query()
            ->where('post_id',$post_id)
            ->join('users','comments.user_id','=','users.id')
            ->select(['comments.created_at','comments.text','comments.post_id','users.name'])
            ->orderBy('created_at', 'DESC')
            ->get();
        return //$comments;
            response()->json([
            'comments'=>  CommentResource::collection( $comments)
                //'comments'=>  $comments
            ]);
    }

    public function store($post_id, CommentRequest $request):JsonResponse
    {
        $user_id = auth()->user()->id;
        if(auth()->user()->role == 3){
            return response()->json([
                'message' => 'Вы не можете оставлять комментарии'
            ]);
        }


        $post = Post::query()->findOrFail($post_id);
        $comment = $post->comments()->create($request->validated());
        return response()->json([
            'user_id'=>$user_id,
            'post_id'=>$post_id,
            'comment'=> new CommentResource($comment),
          //  'test'=>
        ]);
    }

}
