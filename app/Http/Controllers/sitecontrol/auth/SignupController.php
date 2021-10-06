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

class SignupController extends MY_controller
{
    public function __construct()
    {

        
        parent::__construct();
        
        $this->data                               = $this->default_data();
        $this->data['_pagepath']                  = $this->data['admin_path'] . "/auth/create";

        $this->data['_headingtitle']              = "Please Login ";
        $this->data['_pagetitle']                 = $this->data['_headingtitle'] . " - ";
        
      
        $this->data["images_types"]								= "gif,jpg,png,jpeg";
		$this->data["images_mimes"]								= "image/jpeg,image/gif,image/jpg,image/png";


        
        $this->data["_directory"]                               = $this->data['admin_path'] . "auth/";
		$this->data['_pageview']                                = $this->data["_directory"] . "create";

    }

    /**
     * Get admin login in sitecontrol function
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        $remember_me = FALSE;
        /*   

            if ($request->remember_me) {
                $remember_me = TRUE;
            }
        */



        if ($request->isMethod('post')) {


       
            $validation_fields  = [
                "first_name"        => "required",
                "last_name"        => "required",
            
                "email"             => "required|email|unique:pilots",
                "password"          => "required",
                "confirm_password" => "required|same:password",

                "toc"               => "required",
            ];




            $validator                              = Validator::make($request->all(), $validation_fields);


            
            $input_labelName = array(
				"toc"				=> "Terms & Conditions",

			);

			$validator->setAttributeNames($input_labelName);

            
            if ("IMAGE_UPLOAD") {
				#|mimes:' . $config_controls['allowed_types']
				$other_upload       = array(
					"validate"              => "required",
					"input_field"           => "file_user_image",
					"db_field"              => "user_image",
					"input_nick"            => "Profile Image",
					"hdn_field"             => "user_image",
					"tmp_table_field"       => "upload_1",
					"only_validate"			=> FALSE,
					"is_multiple"           => FALSE
				);


				$config_image       = array(
					"upload_path"               => $this->data["images_dir"],
					"allowed_mimes"             => $this->data['images_mimes'],
					"images_types"            	=> $this->data['images_types'],
					"encrypt_name"              => TRUE
				);

				$config_thumb       = array();



				$tmp_upload_image_1 = \App\Http\Helpers\GeneralHelper::upload_image($request, $validator, $config_image, $config_thumb, $other_upload);

				#$validator          = $tmp_upload_image_1['validator'];

				$this->tmp_record_uploads_in_db($request, FALSE, $tmp_upload_image_1);
			}



            

            if ($validator->fails()) {

                return view($this->constants['ADMINCMS_AUTH_TEMPLATE_VIEW'], $this->data)->with("errors", $validator->messages());
            } else {

                $saveData								    = new \App\Models\Pilots();
				$saveData->airline_id	 					= get_airline_ID();
				$saveData->pilot_role_id 					= 4;
				$saveData->first_name						= $request['first_name'];
				$saveData->last_name						= $request['last_name'];
				$saveData->email 							= $request['email'];				
                $saveData->password							= Hash::make($request['password']);

				$saveData->vatsim_id						= $request['vatsim_id'];

				if ($tmp_upload_image_1["error"] == 1 || $tmp_upload_image_1["error"] == 2) {
					$saveData->user_image					= $tmp_upload_image_1["hdn_array"][$other_upload["hdn_field"]];;
				}

				$saveData->join_date						= date("Y-m-d H:i:s");

				$saveData->save();


                $this->data['_messageBundle']		    = $this->_messageBundle(' alert-success alert', "You are successfully registered. Please login to continue.", trans("general_lang.heading_operation_success"), false, true);


                return redirect()->intended(route('domainuser.login'));
            }
        } else {

            return view($this->constants['ADMINCMS_AUTH_TEMPLATE_VIEW'], $this->data);
        }
    }
}
