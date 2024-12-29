<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i=0; $i < 25; $i++) { 
            $member = new Member;

            $member->name = $faker->name;
            $member->email = $faker->email;
            $member->phone_number = '0821'. $faker->randomNumber(9);
            $member->address = $faker->address;
            $member->gender = $faker->randomElement(['L', 'P']);

            $member->save();
        }
    }
}
