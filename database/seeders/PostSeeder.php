<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $json = File::get(path: 'database/json/posts.json');
        $posts = collect(json_decode($json));

        $posts->each(function ($post) {
            Post::create([
                "title" => $post->title,
                "author" => $post->author,
                "content" => $post->content,
                "image_url" => $post->image_url,
                "likes" => $post->likes,
            ]);
        });

        // foreach ($posts as $post) {
        //     Post::create($post);
        // }
    }
}
