<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(50);
        return $posts;
    }

    /**
     * Display the comments of a post
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function comments(Post $post)
    {
        $comments = $post->comments;
        return $comments;
    }
}
