<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Request;
use Auth;
use DB;
use Hash;
use App\Api;
use Flash;

class ApiController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	
        $ApiInfoArray = $this::getActiveApiInfo();
    	
        // $ApiData = DB::table('api')->where('user_id', $userData->id);
		// return $ApiInfoArray;
        return view('api.archive_apidata',compact('ApiInfoArray'));
    }

    public function apiCreateForm()
    {
    	return view('api.actions.api_create');
    }

    public function apiCreate()
    {
        
        //Api name
        $apiName = Request::get('api_name');

        //Make api key
        $salt = 'Il0veAp1z';
        $apiKey = Hash::make($apiName.$salt);

        //Get user logged in user id
        $userObject = Auth::user();
        $userObject->id;

        //set the Api Status
        $apiStatus = 1;

        //Call the Api Model
        $newApi = new Api;

        //Assign Model data
        $newApi->api_name   = $apiName;
        $newApi->user_id    = $userObject->id;
        $newApi->api_key    = $apiKey;
        $newApi->api_status = $apiStatus;

        //save data to Api Model
        $newApi->save();

        $apiID = $newApi->id;

        return view('api.actions.api_view', compact('apiName','apiKey','apiStatus','apiID'));
    }

    public function apiView($id)
    {
        $apiQuery = DB::table('api')->where('id', $id)->get();
        $apiName = $apiQuery[0]->api_name;
        $apiKey = $apiQuery[0]->api_key;
        $apiStatus = $apiQuery[0]->api_status;
        $apiID = $apiQuery[0]->id;

        return view('api.actions.api_view', compact('apiName','apiKey','apiStatus','apiID'));
    }

    public function apiBin()
    {
        $ApiDeleted = $this::getSoftDelApiInfo();
        return view('api.bin',compact('ApiDeleted'));
    }

    public function apiUpdate()
    {
    	//regen the key 
        // rename 
    }

    public function apiDelete($id)
    {

        //sets the primary api to 0 
        DB::table('api')->where('id', $id)->update(['api_status' => 0]);

        //sets all tables to 0
        DB::table('api_data')->where('api_id', $id)->update(['table_status' => 0]);        

        //if has grouped tables set status to 2 as well 
        $apiNameQuery = DB::table('api')->where('id', $id)->get();
        $apiName = $apiNameQuery[0]->api_name;

        $message = $apiName.' API has been move to the bin along with the related tables - Go to <a href="/api-bin">Your Bin</a> to permanatly delete';
            
        
        $ApiInfoArray = $this::getActiveApiInfo();
        Flash::overlay($message,'API moved to Bin');
        return view('api.archive_apidata',compact('ApiInfoArray'));
    }



    private static function getActiveApiInfo()
    {

        //get logged in user id
        $userObject = Auth::user();
        $userObject->id;

        //qeury the bellow based on these credentials
        //the Api name 
        //api tables
        //query db based on user key
        $ApiQuery = DB::table('api')->where('user_id', $userObject->id)->where('api_status', 1)->get();

        $ApiInfoArray = array();
        $i = 0;
        foreach ($ApiQuery as $ApiSingleInfo) {
             $ApiInfoArray[$i]['id'] = $ApiSingleInfo->id;
             $ApiInfoArray[$i]['api_title'] = $ApiSingleInfo->api_name;

            $ApiInfoArray[$i]['api_data'] = array();
            $ApiDataQuery = DB::table('api_data')->where('api_id', $ApiSingleInfo->id)->get();

            $j = 0;
            foreach ($ApiDataQuery as $ApiData) {
                $ApiInfoArray[$i]['api_data'][$j]['api_data_id'] = $ApiData->id;
                $ApiInfoArray[$i]['api_data'][$j]['api_data_table_name'] = $ApiData->table_name;
                $j++;
            }
            $i++;
        }
        return $ApiInfoArray;
    }


    private static function getSoftDelApiInfo()
    {

        //get logged in user id
        $userObject = Auth::user();
        $userObject->id;

        //qeury the bellow based on these credentials
        //the Api name 
        //api tables
        //query db based on user key
        $ApiQuery = DB::table('api')->where('user_id', $userObject->id)->where('api_status', 0)->get();

        $ApiInfoArray = array();
        $i = 0;
        foreach ($ApiQuery as $ApiSingleInfo) {
             $ApiInfoArray[$i]['id'] = $ApiSingleInfo->id;
             $ApiInfoArray[$i]['api_title'] = $ApiSingleInfo->api_name;

            $ApiInfoArray[$i]['api_data'] = array();
            $ApiDataQuery = DB::table('api_data')->where('api_id', $ApiSingleInfo->id)->get();

            $j = 0;
            foreach ($ApiDataQuery as $ApiData) {
                $ApiInfoArray[$i]['api_data'][$j]['api_data_id'] = $ApiData->id;
                $ApiInfoArray[$i]['api_data'][$j]['api_data_table_name'] = $ApiData->table_name;
                $j++;
            }
            $i++;
        }
        return $ApiInfoArray;
    }
}
