<?php

namespace Database\Seeders;

use App\Models\TransactionDetail;
use Faker\Factory as Faker;

use Illuminate\Database\Seeder;

class TransactionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 1; $i++) {
            $transactionDetail = new TransactionDetail;

            $transactionDetail->transaction_id = 1;
            $transactionDetail->book_id = 1;
            $transactionDetail->qty = 1;

            $transactionDetail->save();
        }
    }
}
