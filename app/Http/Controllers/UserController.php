<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Http::get('https://jsonplaceholder.typicode.com/users')
            ->json();
        return $users; 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $user = Http::get("https://jsonplaceholder.typicode.com/users/$user")
            ->json();
        return $user;
    }

    /**
     * Display the posts of a user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function posts($user)
    {
        $posts = Http::get("https://jsonplaceholder.typicode.com/posts?userId=$user")
            ->json();
        return $posts;
    }
}
