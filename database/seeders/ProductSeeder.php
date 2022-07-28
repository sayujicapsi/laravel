<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')
        	->insert([
        		'product_name' => 'Soni Tv',
        		'product_image' => 'soni_tv.jpg',
        		'category_id' => 1,
        		'price' => 20000,
        		'created_at' => Carbon::now(),
        		'updated_at' => Carbon::now(),

        	]);

        DB::table('products')
        	->insert([
        		'product_name' => 'OnePlus Buds',
        		'product_image' => 'one_plus_buds.jpg',
        		'category_id' => 2,
        		'price' => 3000,
        		'created_at' => Carbon::now(),
        		'updated_at' => Carbon::now(),

        	]);
    }
}
