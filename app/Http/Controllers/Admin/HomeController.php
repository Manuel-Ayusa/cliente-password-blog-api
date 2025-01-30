<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' .  config('services.blog-api.access_token_read_resources')
        ])->get('http://api.codersfree.test/v1/categories');

        $categories = json_decode($response)->data;
        $categories = count($categories);

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' .  config('services.blog-api.access_token_read_resources')
        ])->get('http://api.codersfree.test/v1/posts');

        $posts = json_decode($response)->data;
        $posts = count($posts);

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' .  config('services.blog-api.access_token_read_resources')
        ])->get('http://api.codersfree.test/v1/tags');

        $tags = json_decode($response)->data;
        $tags = count($tags);

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' .  config('services.blog-api.access_token_read_resources')
        ])->get('http://api.codersfree.test/v1/roles');

        $roles = json_decode($response)->data;
        $roles = count($roles);

        return view('admin.index', compact('categories', 'posts', 'tags', 'roles'));
    }
}
