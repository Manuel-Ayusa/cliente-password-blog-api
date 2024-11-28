<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

use Symfony\Component\Console\Input\Input;
use Illuminate\Pagination\Paginator;

class PostController extends Controller
{
    

    // public function __construct()
    // {
    //     $this->resolveAuthorization(); //resuelve si el access_token expiro, si es asi se asigna uno nuevo usando el refresh_token
    // }

    public function index()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.codersfree.access_token_read_post')
        ])->get('http://api.codersfree.test/v1/posts?filter[status]=2&&included=images,tags&&sort=-id'); 

        $response = json_decode($response);
        
        $perPage = 8;
        $page = request()->input('page');

        $items = array_slice($response->data, $perPage * ($page - 1), $perPage);;

        $posts = new LengthAwarePaginator($items, count($response->data), $perPage, $page);
        
        $posts->setPath('/');

        return view('posts.index', compact('posts'));
    }

    public function store()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
        ])->post('http://api.codersfree.test/v1/posts', [
            'name' => 'Este es un nombre de prueba 2',
            'slug' => 'Este-es-un-nombre-de-prueba2',
            'stract' => 'sasddsad',
            'body' => 'ssdwdwasddsad',
            'category_id' => 1,
        ]);

        return $response->json();
    }

    //  
    public function show($post){
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.codersfree.access_token_read_post')
        ])->get('http://api.codersfree.test/v1/posts/' . $post . '?included=images,category');

        $post = json_decode($response)->data;

        $category_id = $post->category_id;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.codersfree.access_token_read_post')
        ])->get('http://api.codersfree.test/v1/posts?filter[category_id]=' . $category_id . '&&filter[status]=2&&sort=-id&&perPage=4&&included=images');

        $similares = json_decode($response)->data;

        return view('posts.show', compact(['post', 'similares']));
    }
}
