<?php
use App\ApiData;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ApiDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApiData::create(array(
            'user_id'        => 1,
            'table_name'     => 'test',
            'table_data'     => 'Hello World',
            'table_status'   => 1
        ));
    }
}
