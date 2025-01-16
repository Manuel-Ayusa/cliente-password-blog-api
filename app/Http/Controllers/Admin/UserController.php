<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
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
        $user->roles()->sync($request->roles);

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . auth()->user()->accessToken->access_token
        ])->put('http://api.codersfree.test/v1/users/' . $user->id, $request->all());

        
        if ($response->status() == 200) {
            return redirect()->route('admin.users.edit', $user->id)->with('info', 'Se asignaron los roles correctamente.');    
        } else {
            return redirect()->route('admin.users.edit', $user->id)->with('info', 'Algo falló.');    
        }
    }
}
