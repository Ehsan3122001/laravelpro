<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RoleSeeder::class);

        $adminRole = Role::where('name', 'admin')->first();
        $studentRole = Role::where('name', 'student')->first();

        $admin = User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin User',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole($adminRole);

        $student = User::firstOrCreate([
            'email' => 'student@example.com',
        ], [
            'name' => 'Student User',
            'password' => bcrypt('password'),
        ]);
        $student->assignRole($studentRole);
    }
}
