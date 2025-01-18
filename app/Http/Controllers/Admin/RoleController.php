<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Permission;
//use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $permissions = $request->permissions;
        $permissionsRequest = [];

        foreach ($request->permissions as $permission) {
            $add = Permission::where('id', $permission)->pluck('name')->first();

            array_push($permissionsRequest, $add);
        }

        $request['permissions'] = $permissionsRequest;

        $response = Http::withHeaders([
            'Accept' => 'aplication/json',
            'Autorization' => 'Bearer' . auth()->user()->accessToken->access_token
        ])->post('http://api.codersfree.test/v1/roles', $request);

        if ($response->status() == 201) {
            $role = Role::create($request->all());
            $role->permissions()->sync($permissions);

            return redirect()->route('admin.roles.edit', $role)->with('info', 'El rol se creo con exito.');       
        } else {
            return redirect()->route('admin.roles.create')->with('info', 'Ocurrio un error al crear el rol.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $permissionsUser = $role->permissions;

        return view('admin.roles.edit', compact('role', 'permissions', 'permissionsUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $permissions = $request->permissions;
        $permissionsRequest = [];

        foreach ($request->permissions as $permission) {
            $add = Permission::where('id', $permission)->pluck('name')->first();

            array_push($permissionsRequest, $add);
        }

        $request['permissions'] = $permissionsRequest;

        $response = Http::withHeaders([
            'Accept' => 'aplication/json',
            'Autorization' => 'Bearer' . auth()->user()->accessToken->access_token
        ])->put('http://api.codersfree.test/v1/roles', $request);

        if ($response->status() == 200) {
            $role->update($request->all());
            $role->permissions()->sync($permissions);

            return redirect()->route('admin.roles.edit', $role)->with('info', 'El rol se actualizó con exito.');       
        } else {
            return redirect()->route('admin.roles.create')->with('info', 'Ocurrio un error al actualizar el rol.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $response = Http::withHeaders([
            'Accept' => 'aplication/json',
            'Autorization' => 'Bearer' . auth()->user()->accessToken->access_token
        ])->delete('http://api.codersfree.test/v1/roles', $role);

        if ($response->status() == 200) {
            $role->delete();

            return redirect()->route('admin.roles.index', $role)->with('info', 'El rol se eliminó con exito.');       
        } else {
            return redirect()->route('admin.roles.edit')->with('info', 'Ocurrio un error al eliminar el rol.');
        }
    }
}
