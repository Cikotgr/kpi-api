<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        $role = ['admin', 'staf', 'ob'];
        foreach ($role as $key => $value) {
            Role::create(['name' => $value]);
        }
        
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
        ])->assignRole('admin');

        User::create([
            'name' => 'ob1',
            'email' => 'ob1@gmail.com',
            'password' => bcrypt('ob123'),
        ])->assignRole('ob');

        User::create([
            'name' => 'staf1',
            'email' => 'staf1@gmail.com',
            'password' => bcrypt('staf123'),
        ])->assignRole('staf');

    }
}
