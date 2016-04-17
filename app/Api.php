<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    protected $table   = 'api';
    protected $filable = ['user_id','api_name','api_key','api_status'];}
