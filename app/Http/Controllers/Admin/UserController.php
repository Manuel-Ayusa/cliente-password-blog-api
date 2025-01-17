<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
 
class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('admin.users.index') ,only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('admin.users.edit'), only:['update', 'edit'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index');
    }
 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        $rolesUser = $user->roles;

        return view('admin.users.edit', compact('user', 'roles', 'rolesUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {  
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
        ])->put('http://api.codersfree.test/v1/users/' . $user->id, $request->all());
        
        if ($response->status() == 200) {
            $user->roles()->sync($request->roles);
            return redirect()->route('admin.users.edit', $user->id)->with('info', 'Se asignaron los roles correctamente.');    
        } else {
            return redirect()->route('admin.users.edit', $user->id)->with('info', 'Algo falló.');    
        }
    }
}
