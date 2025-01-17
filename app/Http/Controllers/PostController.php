<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Traits\Paginate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use Paginate, AuthorizesRequests;
    //
    public function index()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.blog-api.access_token_read_resources')
        ])->get('http://api.codersfree.test/v1/posts?filter[status]=2&&included=image,tags&&sort=-id'); 

        
        $posts = json_decode($response)->data;
        
        $posts = $this->paginate($posts, 8);

        return view('posts.index', compact('posts'));
    }

    //  
    public function show(int $post)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.blog-api.access_token_read_resources')
        ])->get('http://api.codersfree.test/v1/posts/' . $post . '?included=image,category');


        $post = json_decode($response)->data;

        if ($post->status != 'PUBLICADO') {
            return abort(403, 'Acción no autorizada.'); 
        }

        $category_id = $post->category_id;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.blog-api.access_token_read_resources')
        ])->get('http://api.codersfree.test/v1/posts?filter[category_id]=' . $category_id . '&&filter[status]=2&&sort=-id&&perPage=4&&included=image');

        $similares = json_decode($response)->data;

        return view('posts.show', compact(['post', 'similares']));
    }

    //
    public function category(int $category)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.blog-api.access_token_read_resources')
        ])->get('http://api.codersfree.test/v1/categories/' . $category . '?included=posts.image,posts.tags');

        $category = json_decode($response)->data;

        $posts = collect($category->posts)->where('status', 'PUBLICADO')->sortByDesc('id');

        $posts = $this->paginate($posts, 8);

        return view('posts.category', compact(['category', 'posts']));
    }

    //
    public function tag(int $tag)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.blog-api.access_token_read_resources')
        ])->get('http://api.codersfree.test/v1/tags/' . $tag . '?included=posts.image,posts.tags');

        $response = json_decode($response);

        $posts = collect($response->data->posts)->where('status', 'PUBLICADO')->sortByDesc('id');
        $tag = $response->data;

        $posts = $this->paginate($posts, 4);

        //return $posts;
        return view('posts.tag', compact(['posts', 'tag']));
    }
}
