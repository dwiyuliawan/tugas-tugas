<?php

namespace Database\Seeders;

use App\Models\Catalog;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i<4; $i++) {
            $catalog = new Catalog;

            $catalog->name = "buku"." " .$faker->name;

            $catalog->save();
        }
    }
}
