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
            $book->title = 'Buku'.' '. $faker->name;
            $book->year = rand(2020, 2024);
            $book->author_id = rand(1,20);
            $book->publisher_id = rand(1,20);
            $book->catalog_id = rand(1,10);
            $book->qty = rand(1,50);
            $book->price = rand(3000, 15000);

            $book->save();
        }
    }
}
