<?php

namespace Database\Seeders;

use App\Models\Member;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $jeniskelamin = ['L','P'];

        for ($i=0; $i<20; $i++) {
            $member = new Member;

            $member->name = $faker->name;
            // $member->gender =  $faker->randomElement(['L', 'P']);
            $member->gender = $jeniskelamin[array_rand($jeniskelamin)];
            $member->phone_number = '0898' .$faker->randomNumber(8);
            $member->address = $faker->address;
            $member->email = $faker->email;
            
            $member->save();
        }
    }
}