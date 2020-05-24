<?php

use App\Post;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/users/{user}/posts', 'UserController@posts')->name('user.posts');
Route::get('/users/{user}', 'UserController@show')->name('user.show');

Route::get('/posts/{post}/comments', 'PostController@comments')->name('post.comments');
Route::get('/posts', 'PostController@index')->name('posts.index');

Route::get('/cache', function () {

    $users = collect(Http::get('https://jsonplaceholder.typicode.com/users')
            ->json());
        

    $posts = collect(Http::get("https://jsonplaceholder.typicode.com/posts/")
                    ->json());

    $comments = collect(Http::get("https://jsonplaceholder.typicode.com/comments/")
                    ->json());

    
    // Since we want the first 50 posts of the first 10 users
    // And the api only has 10 users with each having 10 posts
    // We only need 5 posts per user since the question needs 50 posts
    $users->each(function($user, $key) use($posts, $comments){
        //Store this user in the db
        User::create($user);

        //Get 5 posts of this user
        $user_posts = collect($posts->where('userId', $user['id'])->take(5));

        //store each of the post in the db
        $user_posts->each(function($post, $key) use($comments) {
            $post['user_id'] = $post['userId'];
            // $post['id'] =
            Post::create($post);
            // Get the comments of each of the posts and store in the db
            $post_comments = collect($comments->where('postId', $post['id']));
            $post_comments->each(function($comment, $key){
                $comment['post_id'] = $comment['postId'];
                Comment::create($comment);
            });
        });
    });

    
});

