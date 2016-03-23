<?php
use App\User;
use App\ApiData;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Model::unguard();
        $this->call(UserTableSeeder::class);
        $this->call(ApiDataTableSeeder::class);
    }
}
