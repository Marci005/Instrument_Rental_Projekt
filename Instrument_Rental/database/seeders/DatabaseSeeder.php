<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Order matters:
     *  1. Users — independent table, no foreign keys.
     *  2. Categories and Brands — must exist before Instruments because
     *     Instruments has foreign keys to both.
     *  3. Instruments — depends on Categories and Brands.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            InstrumentCategorySeeder::class,
            InstrumentBrandSeeder::class,
            InstrumentSeeder::class,
        ]);
    }
}
