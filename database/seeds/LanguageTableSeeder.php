<?php

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('languages')->insert([
	            'name' 		=> 'KOR'
	        ]);	
        \DB::table('languages')->insert([
	            'name' 		=> 'VIE'
	        ]);	
        \DB::table('languages')->insert([
	            'name' 		=> 'ENG'
	        ]);	
    }
}
