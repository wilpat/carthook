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
        $users = User::all();
        return $users;
    }

   

    /**
     * Display the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Display the posts of a user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function posts(User $user)
    {
        $posts = $user->posts;
        return $posts;
    }
}
