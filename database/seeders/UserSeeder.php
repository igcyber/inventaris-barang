<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('password'),
        ]);

        $permissions = Permission::all();

        $role = Role::find(1);

        $role->syncPermissions($permissions);

        $user->assignRole($role);
    }
}
