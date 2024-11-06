<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function store()
    {

        $this->resolveAuthorization(); //resuelve si el access_token expiro, si es asi se asigna uno nuevo usando el refresh_token

        /* ---------------------------- */

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

}
