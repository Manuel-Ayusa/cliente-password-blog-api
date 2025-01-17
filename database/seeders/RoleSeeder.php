<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Restablece roles y permisos almacenados en caché
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = Role::create(['name' => 'Admin']);
        $blogger = Role::create(['name' => 'Blogger']);

        Permission::create(['name' => 'admin.home'])->syncRoles([$admin, $blogger]);

        Permission::create(['name' => 'admin.categories.index'])->syncRoles([$admin, $blogger]);
        Permission::create(['name' => 'admin.categories.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.categories.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.categories.destroy'])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.tags.index'])->syncRoles([$admin, $blogger]);
        Permission::create(['name' => 'admin.tags.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.tags.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.tags.destroy'])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.posts.index'])->syncRoles([$admin, $blogger]);
        Permission::create(['name' => 'admin.posts.create'])->syncRoles([$admin, $blogger]);
        Permission::create(['name' => 'admin.posts.edit'])->syncRoles([$admin, $blogger]);
        Permission::create(['name' => 'admin.posts.destroy'])->syncRoles([$admin, $blogger]);

        Permission::create(['name' => 'admin.users.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$admin]);
    }
}
