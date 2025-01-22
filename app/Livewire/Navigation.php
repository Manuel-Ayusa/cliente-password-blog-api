<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Navigation extends Component
{
    public function render()
    {  
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.blog-api.access_token_read_resources')
        ])->get('http://api.codersfree.test/v1/categories');

        $response = json_decode($response);

        $categories = $response->data;

        return view('livewire.navigation', compact('categories'));
    }
}
