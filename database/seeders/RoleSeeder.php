<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Admin', 'slug' => 'admin']);
        Role::create(['name' => 'Bank Mini', 'slug' => 'bank']);
        Role::create(['name' => 'Toko', 'slug' => 'toko']);
        Role::create(['name' => 'Customer', 'slug' => 'customer']);
    }
}
