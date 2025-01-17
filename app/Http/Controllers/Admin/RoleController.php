<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        $role = Role::create($request->all());
        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.edit', $role)->with('info', 'El rol se creo con exito.');
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

        $role->update($request->all());
        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.edit', $role)->with('info', 'El rol se actualizó con exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {

    }
}
