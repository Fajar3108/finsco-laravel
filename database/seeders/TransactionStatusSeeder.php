<?php

namespace Database\Seeders;

use App\Models\TransactionStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionStatus::create(['name' => 'Pending', 'slug' => 'pending']);
        TransactionStatus::create(['name' => 'Success', 'slug' => 'success']);
        TransactionStatus::create(['name' => 'Failed', 'slug' => 'failed']);
    }
}
