<?php

namespace App\Http\Middleware;

//inbulit namespaces
use Closure;
use Illuminate\Support\Facades\Auth;

//extra namespaces
use DB;
use Request;

class ApiAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	if(!empty(Request::get('user_key')) && !empty(Request::get('api_key')))
    	{	
    		//get the keys from the url
    		$apikey  = Request::get('api_key');
    		$userKey = Request::get('user_key');

    		//query db based on user key
    		$userData = DB::table('users')->where('user_key', $userKey)->first();

    		//process the auth attempt
    		if(!empty($userData)){

    			$userStatus = $userData->user_status;
    			$userApiKey = $userData->api_key;

    			if($userStatus === 1)
    			{
    				if($userApiKey === Request::get('api_key'))
    				{
    					if(Auth::loginUsingId($userData->id))
    					{
    						return $next($request);
    					}
    					else
    					{
    						return 'Error: Authentication Failed';
    					}
    				}
    				else
    				{
    					return 'Error: Posted Api Key does not match Stored Api Key';
    				}
    			}
    			else
    			{
    				return 'Error: User is no longer active';
    			}
    		}
    		else{
    			return 'Warning: Invalid Credentials';
    		}
    	}
    	else
    	{
    		return 'Warning: Invalid Credentials';
    	}
    }
}
