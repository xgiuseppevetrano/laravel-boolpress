<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('published', true)->with(['category', 'tags'])->get();

        return $posts;
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with(['category', 'tags', 'user', 'comments' => function($q) {
            $q->where('is_approved', true);
        }])->first();
        if( empty($post) ) {
            return response(['message' => 'Post not found'], 404);
        }

        return $post;
    }
}