<?php
use App\Api;
use Illuminate\Database\Seeder;

class ApiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Api::create(array(
            'user_id'      => 1,
            'api_name'     => 'Test Api',
            'api_key'	   => Hash::make('key'),
            'api_status'   => 1,
        ));

         Api::create(array(
            'user_id'      => 1,
            'api_name'     => 'Second Test Api',
            'api_key'      => Hash::make('key'),
            'api_status'   => 1,
        ));
    }
}
