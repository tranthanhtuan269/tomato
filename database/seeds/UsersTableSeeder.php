<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(User::class, 5)->create();
        \DB::table('users')->insert([
	            'name' 		=> 'admin',
	            'email' 	=> 'admin@tomato.com',
	            'avatar' 	=> 'avatar.jpg',
	            'phone' 	=> '0973619398',
	            'password' 	=> bcrypt('tomato'),
	        ]);	
    }
}
