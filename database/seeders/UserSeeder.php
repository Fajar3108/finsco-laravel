<?php

namespace Database\Seeders;

use App\Models\{User, Role};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default User - Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@finsco.com',
            'password' => bcrypt('password'),
            'role_id' => Role::where('slug', 'admin')->first()->id,
        ]);

        // Default User - Bank Mini
        User::create([
            'name' => 'Bank Mini',
            'email' => 'bank@finsco.com',
            'password' => bcrypt('password'),
            'role_id' => Role::where('slug', 'bank')->first()->id,
        ]);

        // Default User - Toko
        User::create([
            'name' => 'Toko',
            'email' => 'toko@finsco.com',
            'password' => bcrypt('password'),
            'role_id' => Role::where('slug', 'toko')->first()->id,
        ]);

        // Default User - Customer
        User::create([
            'name' => 'Customer',
            'email' => 'customer@finsco.com',
            'password' => bcrypt('password'),
            'role_id' => Role::where('slug', 'customer')->first()->id,
        ]);
    }
}
