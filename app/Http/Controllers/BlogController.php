<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller

{
    public function index()
    {
        // first fetch all posts from db.
        $posts = Post::all();

        return view('blog.index', ['posts' => $posts]);  //|> resources/view/blog->index.blade.php
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('blog.show', ['post' => $post]);
    }

    public function searchPost(Request $req)
    {
        $query = $req->input('query');

        $res = DB::table('posts')
            ->where('author', 'like', "%{$query}%")
            ->orWhere("title", "like", "%{$query}%")
            ->get();


        return view('blog.index', ['posts' => $res]);
    }

    public function showAddPostPage()
    {
        return view('blog.addPost');
    }

    public function showLoginPage()
    {
        return view('auth.login');
    }
    public function showRegisterPage()
    {
        // return '<p>ffs</p>';
        return view('auth.register');
    }


    public function editPost()
    {
        return view('blog.index');
    }

    public function deletePost()
    {
        return view('blog.index');
    }
}
