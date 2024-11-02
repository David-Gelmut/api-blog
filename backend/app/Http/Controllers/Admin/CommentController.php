<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommentFormRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function index():View
    {
    }

    public function edit(Comment $comment):View
    {
        return view('admin.comments.edit',compact('comment'));
    }

    public function update(CommentFormRequest $request,Comment $comment)
    {
        $data = $request->validated();
        $comment->update($data);
        $post = $comment->post;

        return view('admin.posts.edit',compact('post'));
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        $post = $comment->post;

        return view('admin.posts.edit',compact('post'));
    }
}
