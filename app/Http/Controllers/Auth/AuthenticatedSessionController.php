<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

use App\Traits\Token;

class AuthenticatedSessionController extends Controller
{
    use Token;

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])->post('http://api.codersfree.test/v1/login', [
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($response->status() == 404) {
            return back()->withErrors('* These credentials do not match our records.');
        }

        $service = $response->json();

        $user = User::updateOrCreate([
            'email' => $request->email
        ], $service['data']); //busca el usuario con ese email(en la bd del cliente) y si existe lo actualiza si no, lo crea

        if (!$user->accessToken) { //si el usuario no tiene un access token se le asigna uno
            $this->setAccesstoken($user, $service);
        }

        Auth::login($user, $request->remember);

        return redirect()->intended('/dashboard');

        //return $user;
        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
