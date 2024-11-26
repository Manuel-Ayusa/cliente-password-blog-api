<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Navigation extends Component
{
    public function render()
    {   
        if (auth()->user()->accessToken->expires_at <= now()) { ////resuelve si el access_token expiro, si es asi se asigna uno nuevo usando el refresh_token

            $response = Http::withHeaders([
                'Accept' => 'application/json'
            ])->post('http://api.codersfree.test/oauth/token', [
                'grant_type' => 'refresh_token',
                'refresh_token' => auth()->user()->accessToken->refresh_token,
                'client_id' => config('services.codersfree.client_id'),
                'client_secret' => config('services.codersfree.client_secret'),
                'scope' => 'create-post read-post update-post delete-post'
            ]);
    
            $access_token = $response->json();
    
            auth()->user()->accessToken->update([
                'access_token' => $access_token['access_token'],
                'refresh_token' => $access_token['refresh_token'],
                'expires_at' => now()->addSecond( $access_token['expires_in']) //la fecha actual mas los segundos en que expira el access token
            ]);
        }

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
        ])->get('http://api.codersfree.test/v1/categories');

        $categories = json_decode(json_encode($response['data']));

        return view('livewire.navigation', compact('categories'));
    }
}
