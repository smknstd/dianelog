<?php

namespace App\Http\Controllers;


use App\Models\Post;

class HomeController extends Controller
{

    public function index()
    {
        $posts = Post::visible()
            ->orderBy("publish_date","desc")
            ->get();

        return view("home",[
            "posts" => $posts
        ]);
    }
}
