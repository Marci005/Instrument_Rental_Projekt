<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InstrumentCategory;

class InstrumentCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // id: 1
            ['category_name' => 'Akusztikus gitár',  'category_description' => 'Akusztikus gitárok minden szinthez.'],
            // id: 2
            ['category_name' => 'Digitális zongora', 'category_description' => 'Digitális zongorák kezdőknek és profiknak.'],
            // id: 3
            ['category_name' => 'Dobfelszerelés',    'category_description' => 'Akusztikus és elektromos dobok.'],
            // id: 4
            ['category_name' => 'Hegedű',            'category_description' => 'Hegedűk kezdőknek és haladóknak, minden méretben.'],
            // id: 5
            ['category_name' => 'Alt szaxofon',      'category_description' => 'Alt szaxofonok iskolai és professzionális szintre.'],
            // id: 6
            ['category_name' => 'Elektromos gitár',  'category_description' => 'Elektromos gitárok erősítővel és anélkül.'],
        ];

        foreach ($categories as $category) {
            InstrumentCategory::create($category);
        }
    }
}
