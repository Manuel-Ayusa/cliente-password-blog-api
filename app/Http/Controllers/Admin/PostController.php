<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.codersfree.access_token_read_post')
        ])->get('http://api.codersfree.test/v1/categories');

        $categories = json_decode($response)->data;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.codersfree.access_token_read_post')
        ])->get('http://api.codersfree.test/v1/tags');

        $tags = json_decode($response)->data;

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' .  config('services.codersfree.access_token_read_post')
        ])->get('http://api.codersfree.test/v1/posts');

        $posts = json_decode($response)->data;

        $slugs = collect($posts)->pluck('slug'); //selecciona los slugs de la petición

        $slug = Str::slug($request->name, '-'); //convierte el nombre proveniente del formulario en slug

        $request['slug'] = $slug; //agrega la llave 'slug' al request 
        
        $request->validate([
            'name' => 'required',
            'slug' => Rule::notIn($slugs),
            'category_id' => 'required',
            'status' => 'required|in:1,2'
        ]);
        
        if ($request->status == 2) {
            $request->validate([
                'tags' => 'required',
                'stract' => 'required',
                'body' => 'required',
                'image' => 'required|image'
            ]);
        }

        $request['user_id'] = auth()->user()->accessToken->service_id;

        $this->resolveAuthorization();

        if ($request->image) {

            $data = $request->toArray();

            foreach ($data as $key => $value) {
                if ($key == 'tags') {
                    foreach ($request->tags as $key => $value) {
                        $elements[] = [
                            'name' => 'tags[' . $key . ']',
                            'contents' => $value
                        ];
                    }
                } else {
                    
                    $elements[] = [
                        'name' => $key,
                        'contents' => $value
                    ];
                }   
            }

            $imagen_path = $request->file('image');
                
            $response = Http::attach('image', fopen($imagen_path, 'r'))
            ->withHeaders([
                'Accept' => 'application/json image/*',
                'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
            ])
            ->post('http://api.codersfree.test/v1/posts', $elements);
        } else {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
            ])
            ->post('http://api.codersfree.test/v1/posts', $request);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }
}
