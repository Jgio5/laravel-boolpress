<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $data = [
            'posts' => Post::all()
        ];

        return view('guest.posts.index', $data);
        // $posts = Post::all();

        // return response()->json([
        //     'success' => true,
        //     'results' => $posts
        // ]);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if(!$post) {
            abort(404);
        }
        $data = ['post' => $post];
        return view('guest.posts.show', $data);
    }
}
