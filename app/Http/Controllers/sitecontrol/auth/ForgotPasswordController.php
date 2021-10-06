<?php

namespace App\Http\Controllers\sitecontrol\auth;

use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Helpers\GeneralHelper;
use App\Http\Library\RoleManagement;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\MY_controller;
use Dotenv\Util\Str;

class ForgotPasswordController extends MY_controller
{
    public function __construct()
    {

        parent::__construct();
        
        $this->data                               = $this->default_data();
        $this->data['_pagepath']                  = $this->data['admin_path'] . "/auth/forgotpassword";

        $this->data['_headingtitle']              = "Forgot Password ";
        $this->data['_pagetitle']                 = $this->data['_headingtitle'] . " - ";
        
      

        
        $this->data["_directory"]                               = $this->data['admin_path'] . "auth/";
		$this->data['_pageview']                                = $this->data["_directory"] . "forgotpassword";

    }

    /**
     * Get admin login in sitecontrol function
     *
     * @param Request $request
     * @return void
     */
    public function getForgotPassword(Request $request)
    {
        if ($request->isMethod('post')) {
       
            $validation_fields  = [
                "email"             => "required|email|useremailexist:" . \Config::get('constants.GUARD_DOMAIN_USER') . "," . get_airline_ID(),
            ];

            $validator                              = Validator::make($request->all(), $validation_fields);


            
            $input_labelName = array(
				"email"				=> "Email",
			);

			$validator->setAttributeNames($input_labelName);

            if ($validator->fails()) {

                return view($this->constants['ADMINCMS_AUTH_TEMPLATE_VIEW'], $this->data)->with("errors", $validator->messages());
            } else {
                
                $_newpassword                               = \Str::random(8);
                $saveData							        = \App\Models\Pilots::where("email", $request->email)->where("airline_id", get_airline_ID())->get()->first();
                $saveData->password							= Hash::make( $_newpassword );
				$saveData->save();


                       
                $email_template				= array("email_to"				=> $request->email,
                                                    "email_heading"			=> get_airline_NAME() . ' - Password Reset',
                                                    "email_subject"			=> get_airline_NAME() . ' - Password Reset',
                                                    'email_file_HTML'       => "Your new password for " . $request->email . " is: " . $_newpassword,
                                                    "default_subject"		=> TRUE,
                                                    "email_post"			=> $_POST,);

                $this->_send_email( $email_template );



               
                $this->data['_messageBundle']		    = $this->_messageBundle(' alert-success alert', "Your password has been changed and email to " . $request->email, trans("general_lang.heading_operation_success"), false, true);


                return redirect()->intended(route('domainuser.login'));
            }
        } else {

            return view($this->constants['ADMINCMS_AUTH_TEMPLATE_VIEW'], $this->data);
        }
    }
}
