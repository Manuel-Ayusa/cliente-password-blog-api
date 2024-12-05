<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait Token{

    public function setAccesstoken($user, $service)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->post('http://api.codersfree.test/oauth/token', [
            'grant_type' => 'password',
            'client_id' => config('services.blog-api.client_id'),
            'client_secret' => config('services.blog-api.client_secret'),
            'username' => request()->email,
            'password' => request()->password,
            'scope' => '*'
        ]);

        $access_token = $response->json();

        $user->accessToken()->create([
            'service_id' => $service['data']['id'],
            'access_token' => $access_token['access_token'],
            'refresh_token' => $access_token['refresh_token'],
            'expires_at' => now()->addSecond( $access_token['expires_in']) //la fecha actual mas los segundos en que expira el access token
        ]);
    }
}