<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            MemberSeeder::class,
            PublisherSeeder::class,
            AuthorSeeder::class,
            CatalogSeeder::class,
            BookSeeder::class,
            TransactionSeeder::class,
            TransactionDetailSeeder::class,
        ]);
    }
}
