<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

abstract class Controller
{
    public function resolveAuthorization()
    {
        if (auth()->user()->accessToken->expires_at <= now()) {

            $response = Http::withHeaders([
                'Accept' => 'application/json'
            ])->post('http://api.codersfree.test/oauth/token', [
                'grant_type' => 'refresh_token',
                'refresh_token' => auth()->user()->accessToken->refresh_token,
                'client_id' => config('services.blog-api.client_id'),
                'client_secret' => config('services.blog-api.client_secret'),
                'scope' => 'create-post read-post update-post delete-post create-category read-category update-category delete-category create-tag read-tag update-tag delete-tag'
            ]);
    
            $access_token = $response->json();
    
            auth()->user()->accessToken->update([
                'access_token' => $access_token['access_token'],
                'refresh_token' => $access_token['refresh_token'],
                'expires_at' => now()->addSecond( $access_token['expires_in']) //la fecha actual mas los segundos en que expira el access token
            ]);
        }
    }
}
