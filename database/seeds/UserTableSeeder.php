<?php
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
	        'name'     	  => 'Lee Zerafa',
	        'email'    	  => 'lee@api.com',
	        'password' 	  => Hash::make('abc123'),
	        'api_key'	  => Hash::make('key'),
	        'user_key'	  => Hash::make('lee@api.com'),
            'user_status' => 1,
	    ));
    }
}
