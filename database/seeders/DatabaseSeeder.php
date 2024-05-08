<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ItemCategory;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        Role::factory(4)->create();
        ItemCategory::factory(2)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role_id' => Role::where('name', 'admin')->first()->id,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'customer',
            'username' => 'customer',
            'email' => 'customer@gmail.com',
            'role_id' => Role::where('name', 'customer')->first()->id,
        ]);
    }
}
