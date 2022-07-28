<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')
        	->insert([
        		'category_name' => 'Television',
        		'created_at' => Carbon::now(),
        		'updated_at' => Carbon::now()
        		
        	]);
        DB::table('categories')
        	->insert([
        		'category_name' => 'Headphones',
        		'created_at' => Carbon::now(),
        		'updated_at' => Carbon::now()
        		
        	]);
    }
}
