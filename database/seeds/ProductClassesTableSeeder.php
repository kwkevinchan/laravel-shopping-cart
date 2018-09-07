<?php

use Illuminate\Database\Seeder;
use App\Models\ProductClass;

class ProductClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<10;$i++){
            ProductClass::create([
                'name' => '類別'. $i
            ]);
        }
    }
}
