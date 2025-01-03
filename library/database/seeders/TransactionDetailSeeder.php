<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Models\TransactionDetail;

class TransactionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i=0; $i < 4; $i++) { 
            $transactionDetail = new TransactionDetail;

            $transactionDetail->transaction_id = rand(1,5);
            $transactionDetail->book_id = rand(1,5);
            $transactionDetail->qty = rand(5,20);

            $transactionDetail->save();
        }
    }
}
