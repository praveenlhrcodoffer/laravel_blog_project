<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

        $userId  = auth()->id();
        // $imagePath = $request->file('image')->store('public');
        $imagePath = $request->file('image')->store('images', 'public');


        // dd($imagePath);

        DB::table('posts')->insert([
            'title' => $request->title,
            'author' => $request->author,
            'content' => $request->content,
            'image_url' => $imagePath,
            'user_id' => $userId
        ]);

        return redirect()->route('posts.home');
    }

    public function editPost()
    {
        return view('blog.index');
    }

    public function deletePostFromDb(string $id)
    {
        // dd($id);
        $post = Post::find($id);
        $post->delete();

        // return view('blog.index'); //|> this would give error at blog.index page as view blog.index expects to receive some data to be explicitly pass in order to render properly

        return redirect()->route('posts.home');
    }
}
