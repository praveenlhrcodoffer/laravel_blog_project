<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller

{
    public function index()
    {
        // first fetch all posts from db.
        $posts = Post::all();

        return view('blog.index', ['posts' => $posts]);  //|> resources/view/blog->index.blade.php
    }
    // --------------------------------------------------------------------------------------------------
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


        return response()->json(['data' => $res], 200);
        // return view('blog.index', ['posts' => $res]);
    }

    // --------------------------------------------------------------------------------------------------

    public function showPostCreatePage()
    {
        return view('blog.addPost');
    }

    public function showLoginPage()
    {
        return view('auth.login');
    }

    public function showRegisterPage()
    {
        return view('auth.register');
    }

    //|> Add
    public function addPostToDb(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'author' => 'required|string',
            'content' => 'required|min:10',
            'image' => 'required|image'
        ]);

        if ($validator->fails()) {

            $errors = $validator->errors();
            return response()->json(['errors' => $errors], 400);
        } else {

            $imagePath = $request->file('image')->store('images', 'public');
            $userId  = auth()->id();

            DB::table('posts')->insert([
                'title' => $request->title,
                'author' => $request->author,
                'content' => $request->content,
                'image_url' => $imagePath,
                'user_id' => $userId
            ]);
            return response()->json(['success' => 'Post added successfully'], 200);
            // return redirect()->route('posts.home');
        }
    }

    // --------------------------------------------------------------------------------------------------
    //|> Delete
    public function deletePostFromDb(string $id)
    {
        // dd($id);
        $post = Post::find($id);
        $post->delete();

        // return view('blog.index'); //|> This would give error at blog.index page as view blog.index expects to receive some data to be explicitly pass in order to render properly

        return redirect()->route('posts.home');
    }
    // --------------------------------------------------------------------------------------------------
    // |> update
    public function updatePost(Request $request, string $id)
    {
        $post = Post::find($id);

        // Update the post attributes with the values from the request
        $post->title = $request->input('title');
        $post->author = $request->input('author');
        $post->content = $request->input('content');


        // dd($request->all());
        // Handle file upload if a new image is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');

            // dd($imagePath);
            $post->image_url = $imagePath;
        }

        // Save the changes to the database
        $post->save();

        // Redirect the user to the home page
        return redirect()->route('posts.detail', ['id' => $id]);
    }
}
