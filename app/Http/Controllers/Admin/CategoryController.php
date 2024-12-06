<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

use App\Models\User;

use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' .  config('services.codersfree.access_token_read_post')
        ])->get('http://api.codersfree.test/v1/categories');

        $categories = json_decode($response)->data;
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' .  config('services.codersfree.access_token_read_post')
        ])->get('http://api.codersfree.test/v1/categories');

        $categories = json_decode($response)->data;

        $slugs = collect($categories)->pluck('slug'); //selecciona los slugs de la petición

        $slug = Str::slug($request->name, '-'); //convierte el nombre proveniente del formulario en slug

        $request['slug'] = $slug; //agrega la llave 'slug' al request 

        $request->validate([
            'name' => 'required|max:250',
            'slug' => Rule::notIn($slugs)
        ]);//valida que el slug no se repita

        $this->resolveAuthorization(); //resuelve si el access_token expiro, si es asi se asigna uno nuevo

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
        ])->post('http://api.codersfree.test/v1/categories', $request);

        $category = json_decode($response)->data;

        return redirect()->route('admin.categories.edit', $category->id)->with('info', 'La categoria se creo con exito.');
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
    public function edit(int $category)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
        ])->get('http://api.codersfree.test/v1/categories/' . $category);

        $category = json_decode($response)->data;

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $category)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' .  config('services.codersfree.access_token_read_post')
        ])->get('http://api.codersfree.test/v1/categories');

        $categories = json_decode($response)->data;

        $slugs = collect($categories)->where('id', '!=', $category)->pluck('slug'); //recupera todos los slugs menos el de la categoria a actualizar

        $slug = Str::slug($request->name, '-');

        $request['slug'] = $slug; 

        $request->validate([
            'name' => 'required|max:250',
            'slug' => Rule::notIn($slugs)
        ]);

        $this->resolveAuthorization();

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
        ])->put('http://api.codersfree.test/v1/categories/' . $category, $request);

        return redirect()->route('admin.categories.edit', $category)->with('info', 'La categoria se actualizó con exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $category)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
        ])->delete('http://api.codersfree.test/v1/categories/' . $category);

        return redirect()->route('admin.categories.index', $category)->with('info', 'La categoría se eliminó con exito.');
    }
}
