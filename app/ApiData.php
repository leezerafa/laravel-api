<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiData extends Model
{
    protected $table   = 'api_data';
    protected $filable = ['user_id','table_name','table_data','table_status'];

}
