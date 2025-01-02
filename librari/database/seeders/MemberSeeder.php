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
        for ($i=0; $i < 20; $i++) { 
            $member = new Member;

            $member->name = 'Mrs.'.' '. $faker->name;
            $member->gender = $faker->randomElement(['L', 'P']);
            $member->phone_number = '0821'. $faker->randomNumber(7);
            $member->address = 'Jl.'.' '. $faker->address;
            $member->email = $faker->email;

            $member->save();
        }
    }
}
