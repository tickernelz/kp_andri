<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'kelola pengguna']);
        Permission::create(['name' => 'pengaturan']);
        Permission::create(['name' => 'kelola data']);
        Permission::create(['name' => 'melihat data']);

        $role1 = Role::create([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);
        $role1->givePermissionTo('kelola pengguna');
        $role1->givePermissionTo('kelola data');
        $role1->givePermissionTo('pengaturan');

        $role2 = Role::create([
            'name' => 'Kader',
            'guard_name' => 'web',
        ]);
        $role2->givePermissionTo('kelola data');

        $role3 = Role::create([
            'name' => 'Pengguna',
            'guard_name' => 'web',
        ]);
        $role3->givePermissionTo('melihat data');
    }
}
