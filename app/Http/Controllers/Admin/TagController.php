<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' .  config('services.codersfree.access_token_read_post')
        ])->get('http://api.codersfree.test/v1/tags');

        $tags = json_decode($response)->data;

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' .  config('services.codersfree.access_token_read_post')
        ])->get('http://api.codersfree.test/v1/tags');

        $tags = json_decode($response)->data;

        $slugs = collect($tags)->pluck('slug'); //selecciona los slugs de la petición

        $slug = Str::slug($request->name, '-'); //convierte el nombre proveniente del formulario en slug

        $request['slug'] = $slug; //agrega la llave 'slug' al request 
        
        $request->validate([
            'name' => 'required|max:250',
            'slug' => Rule::notIn($slugs),
            'color' => 'required'
        ]);//valida que el slug no se repita

        $this->resolveAuthorization(); //resuelve si el access_token expiro, si es asi se asigna uno nuevo

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
        ])->post('http://api.codersfree.test/v1/tags', $request);

        $category = json_decode($response)->data;

        return redirect()->route('admin.tags.edit', $category->id)->with('info', 'La etiqueta se creo con exito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $tag)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
        ])->get('http://api.codersfree.test/v1/tags/' . $tag);

        $tag = json_decode($response)->data;

        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $tag)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' .  config('services.codersfree.access_token_read_post')
        ])->get('http://api.codersfree.test/v1/tags');

        $tags = json_decode($response)->data;

        $slugs = collect($tags)->where('id', '!=', $tag)->pluck('slug'); //recupera todos los slugs menos el de la categoria a actualizar

        $slug = Str::slug($request->name, '-');

        $request['slug'] = $slug; 

        $request->validate([
            'name' => 'required|max:250',
            'slug' => Rule::notIn($slugs),
            'color' => 'required'
        ]);

        $this->resolveAuthorization();

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
        ])->put('http://api.codersfree.test/v1/tags/' . $tag, $request);

        return redirect()->route('admin.tags.edit', $tag)->with('info', 'La etiqueta se actualizó con exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $tag)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
        ])->delete('http://api.codersfree.test/v1/tags/' . $tag);

        return redirect()->route('admin.tags.index', $tag)->with('info', 'La etiqueta se eliminó con exito.');
    }
}
