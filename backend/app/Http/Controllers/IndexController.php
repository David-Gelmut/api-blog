<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function index():View
    {
        $posts = Post::query()->orderBy('created_at', 'DESC')->limit(3)->get();

        return view('index', compact('posts'));
    }
}
