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

    public function showDetailPost($id)
    {
        $post = Post::find($id);

        return view('blog.showPost', ['post' => $post]);
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

    public function addPostToDb(Request $request)
    {
        // $validatedData = $request->validate([
        //     'title' => 'required|string',
        //     'author' => 'required|string',
        //     'content' => 'required|string',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Define validation rules for the image
        // ]);

        dd($request->all());
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
