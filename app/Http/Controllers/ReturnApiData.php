<?php

namespace App\Http\Controllers;

use App\ApiData;
use Auth;
use Request;
use DB;

class ReturnApiData extends Controller
{
    public function gettest()
    {
    	//Variables to pass to the query
		$userID = Auth::user()->id;
		$tableName = Request::get('table_name');

		if(!empty($tableName)){
			$QueriedData = DB::table('api_data')->where('user_id',$userID)->where('table_name',$tableName)->first();

			if(!empty($QueriedData)){
				$dataArray = array(
					'table_name'=>$QueriedData->table_name,
					'data' => array('page_data' => $QueriedData->table_data),
				);
				return json_encode($dataArray);
			}
			return 'Error: Table Name Invalid';
			
		}
		return 'Error: Table Name Empty';


		
	}


	    public function get()
	    {
	    	//Variables to pass to the query
			$userID = Auth::user()->id;
			$tableName = Request::get('table_name');

			$QueriedData = DB::table('api_data')->where('user_id',$userID)->where('table_name',$tableName)->first();

			return $QueriedData->table_data;
		}
}
