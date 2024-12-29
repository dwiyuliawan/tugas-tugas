<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i=0; $i < 20; $i++) { 
            $book = new Book;

            $book->isbn = $faker->randomNumber(4);
            $book->title = 'Drs.'. $faker->name;
            $book->year = rand(2015, 2024);
            $book->author_id = rand(1, 25);
            $book->publisher_id = rand(1, 25);
            $book->catalog_id = rand(1, 15);
            $book->qty = rand(5, 20);
            $book->price = rand(50000, 5000000);

            $book->save();
        }
    }
}
