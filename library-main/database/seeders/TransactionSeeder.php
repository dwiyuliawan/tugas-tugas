<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Faker\Factory as Faker;

use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
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
            $transaction = new Transaction;

            $transaction->member_id = 1;
            $transaction->date_start = $faker->date;
            $transaction->date_end = $faker->date;
            $transaction->status = $faker->randomElement(['Finished', 'Borrowed']);

            $transaction->save();
        }
    }
}
