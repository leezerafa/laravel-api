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
            'api_id'        => 1,
            'table_name'     => 'test',
            'table_data'     => 'Hello World',
            'table_status'   => 1
        ));

        ApiData::create(array(
            'api_id'        => 1,
            'table_name'     => 'test2',
            'table_data'     => 'Hello lolzor',
            'table_status'   => 1
        ));

        ApiData::create(array(
            'api_id'        => 2,
            'table_name'     => 'Second Data Table',
            'table_data'     => 'Hello World 2',
            'table_status'   => 1
        ));
    }
}
