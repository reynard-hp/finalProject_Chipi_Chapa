<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(UserSeeder::class);

        Category::create([
            'Name' => 'Furniture'
        ]);

        Category::create([
            'Name' => 'Sport'
        ]);

        Category::create([
            'Name' => 'Electronic Devices'
        ]);

        Item::create([
            'Name' => 'Mouse X12',
            'Price' => '50000',
            'Quantity' => '47',
            'CategoryId' => 3
        ]);

        Item::create([
            'Name' => 'Lemari Kayu',
            'Price' => '650000',
            'Quantity' => '55',
            'CategoryId' => 1
        ]);

        Item::create([
            'Name' => 'Monitor MM300',
            'Price' => '1200000',
            'Quantity' => '42',
            'CategoryId' => 3
        ]);
    }
}
