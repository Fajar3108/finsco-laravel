<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionType::create(['name' => 'Top Up', 'slug' => 'top-up']);
        TransactionType::create(['name' => 'Withdraw', 'slug' => 'withdraw']);
        TransactionType::create(['name' => 'Purchase', 'slug' => 'purchase']);
        TransactionType::create(['name' => 'Transafer', 'slug' => 'transfer']);
    }
}
