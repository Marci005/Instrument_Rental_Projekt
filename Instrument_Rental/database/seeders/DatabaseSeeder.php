<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Order matters: categories and brands must be seeded before instruments
     * because instruments has foreign keys to both.
     */
    public function run(): void
    {
        $this->call([
            InstrumentCategorySeeder::class,
            InstrumentBrandSeeder::class,
            InstrumentSeeder::class,
        ]);
    }
}
