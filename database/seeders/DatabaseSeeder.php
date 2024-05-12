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

        \App\Models\User::factory()->create([
            'name' => 'seller',
            'username' => 'seller',
            'email' => 'seller@gmail.com',
            'role_id' => Role::where('name', 'seller')->first()->id,
        ]);

        $weaver = \App\Models\User::factory()->create([
            'name' => 'weaver',
            'username' => 'weaver',
            'phone_number' => '081234567890',
            'date_of_birth' => '1990-01-01',
            'gender' => 'men',
            'email' => 'weaver@gmail.com',
            'role_id' => Role::where('name', 'weaver')->first()->id,
        ]);

        $weaver->addresses()->create([
            'city' => 'Bandung',
            'province' => 'Jawa Barat',
            'address' => 'Jl. Raya Bandung',
            'postal_code' => '40291',
            'additional_information' => 'Rumah warna biru',
        ]);
    }
}
