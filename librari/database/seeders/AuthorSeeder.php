<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i=0; $i < 10; $i++) { 
            $author = new Author;

            $author->name = 'Drs.'.' '. $faker->name;
            $author->email = $faker->email;
            $author->phone_number = '0898'.$faker->randomNumber(8);
            $author->address = $faker->address;

            $author->save();
        }
    }
}
