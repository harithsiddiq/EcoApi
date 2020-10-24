<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        factory('App\Models\Product', 10)->create();
    }
}
