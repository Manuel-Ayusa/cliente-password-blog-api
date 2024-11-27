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
            'Authorization' => 'Bearer ' . config('services.codersfree.access_token_read_post')
        ])->get('http://api.codersfree.test/v1/categories');

        $response = json_decode($response);

        $categories = $response->data;

        return view('livewire.navigation', compact('categories'));
    }
}
