<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Permission::create(['name' => 'edit movies']);
        Permission::create(['name' => 'edit actors']);
        Permission::create(['name' => 'edit categories']);
        Permission::create(['name' => 'rate movies']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo('rate movies');

        // Movie::factory(7)->create();

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
        ]);

        $role = Role::findByName('admin');
        $user->roles()->save($role);

        // User::factory(2)->create()->each(function ($user) {
        //     $user->assignRole('user');
        // });
    }
}
