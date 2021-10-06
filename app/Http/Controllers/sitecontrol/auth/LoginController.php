<?php

namespace App\Http\Controllers\sitecontrol\auth;

use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Library\RoleManagement;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\MY_controller;
use App\Models\RolePermissions;
use Illuminate\Support\Facades\Hash;

class LoginController extends MY_controller
{
    public function __construct()
    {

        parent::__construct();
        
        $this->data                               = $this->default_data();
        $this->data['_pagepath']                  = $this->data['admin_path'] . "/auth/login";

        $this->data['_headingtitle']              = "Please Login ";
        $this->data['_pagetitle']                 = $this->data['_headingtitle'] . " - ";



        $this->data["_directory"]                               = $this->data['admin_path'] . "auth/";
		$this->data['_pageview']                                = $this->data["_directory"] . "login";

      
    }

    /**
     * Get admin login in sitecontrol function
     *
     * @param Request $request
     * @return void
     */
    public function getLogin(Request $request)
    {
        
        $remember_me = FALSE;
        /*   

            if ($request->remember_me) {
                $remember_me = TRUE;
            }
        */


        if ($request->isMethod('post')) {


            
            $validation_fields  = [
                "email"             => "required|email|useremailexist:". \Config::get('constants.GUARD_DOMAIN_USER') .",". get_airline_ID() ."|logincredentials:email,password," . \Config::get('constants.GUARD_DOMAIN_USER') . "," . get_airline_ID(),
                "password"          => "required",
            ];

            $validator                              = Validator::make($request->all(), $validation_fields);

            if ($validator->fails()) {

                return view($this->constants['ADMINCMS_AUTH_TEMPLATE_VIEW'], $this->data)->with("errors", $validator->messages());
            } else {


                

                $credentials = [
                    "email"     => $request->email,
                    "password"  => $request["password"]
                ];

            

                Auth::guard(   \Config::get('constants.GUARD_DOMAIN_USER') ) -> logout();    
                $request->session()->flush();
                Auth::guard( \Config::get('constants.GUARD_DOMAIN_USER') )->attempt ( $credentials, $remember_me );

                $TMP_admin_data                =  Auth::guard(   RoleManagement::get_current_user_logged_in_GUARD()  );
                $TMP_full_data                  = $TMP_admin_data->getUser()->toArray();
                $TMP_full_data["full_name"]     = $TMP_full_data["first_name"] . " " . $TMP_full_data["last_name"];
                
                \Session::put("logged_in_user_data", $TMP_full_data);


                $_role_permissions_details = RolePermissions::where("pilot_role_id", $TMP_full_data["pilot_role_id"])->where("operation", "redirect_after_login");
                if ( $_role_permissions_details->count() > 0 )
                {

                    if ( $_role_permissions_details->get()->first()->directory == "/" )
                    {
                        return redirect( url('/') );
                    }
                    else 
                    {
                        return redirect()->intended(route( $_role_permissions_details->get()->first()->directory ));
                    }
                }
                else
                {
                    
                    return redirect()->intended(route('dashboard.view'));
                }
            }
        } else {


            return view($this->constants["ADMINCMS_AUTH_TEMPLATE_VIEW"], $this->data);


            #return view($this->data['_pagepath'], $this->data);
        }
    }
}
