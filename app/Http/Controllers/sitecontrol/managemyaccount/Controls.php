<?php

namespace App\Http\Controllers\sitecontrol\managemyaccount;

use Validator;
use App\Models\Pilots;
use Illuminate\Http\Request;
use App\Models\FlightHistory;
use Yajra\DataTables\Html\Builder;
use App\Http\Helpers\GeneralHelper;
use App\Http\Library\RoleManagement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MY_controller;
use App\Http\Requests\StoreManageMyAccountRequest;
use App\Http\Controllers\common\CommonMyAccountController;

class Controls extends MY_controller
{
	function __construct()
	{
		parent::__construct();


		$this->data = $this->default_data();

		
		$this->data["_heading"]                                 = "Account Settings";

		$this->data["breadcrumbs_list"]							= array(

			"page_title"		=> $this->data["_heading"],
			"links_list"		=> array(

				[
					"name"		=> "Home",
					"url"		=> url('/')
				],
				[
					"name"		=> $this->data["_heading"],
				]
			)
			
		);



		$this->data["_pagetitle"]                               = $this->data["_heading"] . " - ";
		$this->data["_directory"]                               = $this->data['admin_path'] . "managemyaccount/";
		$this->data['_pageview']                                = $this->data["_directory"] . "view";

		$this->data["images_types"]								= "gif,jpg,png,jpeg";
		$this->data["images_mimes"]								= "image/jpeg,image/gif,image/jpg,image/png";
		$this->data["images_dir"]								= "assets/uploads/user_images/";
		$this->data['_messageBundle_2']                       	= FALSE;
        


		$this->data['active_overview'] = $this->data['active_settings'] = FALSE;
	
		$this->input_fields	 									= [ 'hub_id', 'rank_id', 'images_types|images_types',  'notifications', 'first_name','last_name','email', "bio", "call_sign", "number_flights", "vatsim_id", "current_password", "new_password", "new_confirm_password", "user_image", 'id','option'];
		$this->fillable_inputs 									= [ 'hub_id', 'rank_id', 'images_types', 'notifications', 'first_name','last_name','email', "bio", "call_sign", "number_flights", "vatsim_id", "current_password", "new_password", "new_confirm_password", "user_image", 'id','option'];

		GeneralHelper::form_fields_generator($this->data, false,  [], $this->input_fields, $this->fillable_inputs);

	}

	/**
	 * 
	 * @param Request $request
	 * @param Builder $htmlBuilder
	 * @param string $view_filter
	 * @return void
	 */
	public function view(Request $request, Builder $htmlBuilder,  $pilot_id = FALSE)
	{
		// return redirect( $this->data["_directory"] . "edit/" . RoleManagement::getCurrent_LoggedInID(  \Config::get('constants.GUARD_SUPER_ADMIN')  ) );

		if ( $pilot_id === FALSE )
		{
			$pilot_id = Auth::guard(RoleManagement::get_current_user_logged_in_GUARD())->user()->id;
		}

		$_records											= Pilots::where("id", $pilot_id)->where("airline_id", get_airline_ID() );

		if ($_records->count() <= 0) {
			return GeneralHelper::show_error_page("404");
		}


		$this->data['active_overview']							= TRUE;
		$this->data["breadcrumbs_list"]							= array(

			"page_title"		=> $this->data["_heading"] = "Account Overview",
			"links_list"		=> array(

				[
					"name"		=> "Home",
					"url"		=> url('/')
				],
				[
					"name"		=> $this->data["_heading"],
				]
			)

		);



		
		$this->data['pilot_id']									= $pilot_id;
		$this->data['pilot_details']        					= $_records->get()->first();
		$this->data['favorite_aircrafts']						= $this->data['pilot_details']->favorite_aircrafts()->get();
 
		$this->data['flight_history_records']          			= FlightHistory::where("pilot_id", $pilot_id);


		$this->data['_pageview'] 								= $this->data["_directory"] . "pilot_details";

		return view($this->constants["ADMINCMS_TEMPLATE_VIEW"], $this->data);


	}


	public function edit( Request $request, $pilot_id = FALSE)
	{

		
		if ( $pilot_id === FALSE )
		{
			$pilot_id = Auth::guard(RoleManagement::get_current_user_logged_in_GUARD())->user()->id;
		}



		$_records											= Pilots::where("id", $pilot_id)->where("airline_id", get_airline_ID() );

	
		if ($_records->count() <= 0 ) {
			return GeneralHelper::show_error_page("404");
		}



		if ($pilot_id !=  RoleManagement::get_current_user_logged_in_ID (RoleManagement::get_current_user_logged_in_GUARD()) )
		{
			return GeneralHelper::show_error_page("404");
		}


		
		$this->data['active_settings']							= TRUE;
		$this->data['_pageview']                                = $this->data["_directory"] . "edit";  
		$_record                                				= $_records->get()->first()->toArray();
		$_record['option']                            			= "edit";
		$_record['current_password']							= "";
		$_record['new_password']								= "";
		$_record['new_confirm_password']						= "";
		$_record["images_types"]								= $this->data["images_types"];
		



		$this->data['pilot_id']									= $pilot_id;
		$this->data['pilot_details']        					= $_records->get()->first();
		$this->data['favorite_aircrafts']						= $this->data['pilot_details']->favorite_aircrafts()->get();

		
		GeneralHelper::form_fields_generator($this->data, TRUE,  $_record, $this->input_fields, $this->fillable_inputs);
	
		return view($this->constants["ADMINCMS_TEMPLATE_VIEW"], $this->data);
	}

	public function validate_form( $request )
	{
		$other_upload = array();
		$tmp_upload_image_1 = array();


		if ( $request->option == "update_credentials" )
		{
			
			$tmp_validate_EMAIL								= $this->find_duplicate_values(\App\Models\Pilots::where("email", $request->email), Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )->user()->id);
		
			$TMP_validate["email"]							= "required|email|duplicate:" . $tmp_validate_EMAIL;
			$TMP_validate["confirm_password"]				= "required|min:8|currentloggedinpassword";

	
			
			$validator = Validator::make($request->all(), $TMP_validate);
	

			$input_labelName = array(
				'email'									=> "Email",
				'confirm_password'           			=> 'Confirm Password',			
			);
	
			$validator->setAttributeNames($input_labelName);

		}
		else if ( $request->option == "change_password" )
		{
			
			
			$TMP_validate["current_password"]				= "required|currentloggedinpassword";
			$TMP_validate["new_password"]					= "required|min:8";
			$TMP_validate["confirm_password"]				= "required|min:8";

	
			
			$validator = Validator::make($request->all(), $TMP_validate);
	

			$input_labelName = array(
				'current_password'									=> "Current Password",
				'new_password'           			=> 'New Password',			
				'confirm_password'           			=> 'Confirm Password',			
			);
	
			$validator->setAttributeNames($input_labelName);

		}
		else if ( $request->option == "update_hub_and_rank" )
		{
			
			
			$TMP_validate["hub_id"]						= "required";
			$TMP_validate["rank_id"]					= "required";

	
			
			$validator = Validator::make($request->all(), $TMP_validate);
	

			$input_labelName = array(
				'hub_id'									=> "Hub",
				'rank_id'           			=> 'Rank',			
			);
	
			$validator->setAttributeNames($input_labelName);

		}
		else {
			
			$validator = Validator::make($request->all(), [
				"id"                    => "trim",
				"option"               => "trim",
				"unique_formid"         => "trim",
	
				"first_name"			=> "required",
				"last_name"				=> "required",
				"bio"                	=> "trim",
				"call_sign"                	=> "trim",
				"number_flights"                	=> "trim",
				"vatsim_id"                	=> "trim",
				"rank_id"                	=> "trim|required",
				"notifications"                	=> "trim",
			]);
	
	
			$input_labelName = array(
				'name'									=> "Name",
				'username'								=> "Username",
				'email'           						=> 'Email',		
				'rank_id'								=> "Rank",	
				
			);
	
			$validator->setAttributeNames($input_labelName);
	
	
	
			 
			if ( "IMAGE_UPLOAD" )
			{
				#|mimes:' . $config_controls['allowed_types']
				$other_upload       = array(    "validate"              => "required",
												"input_field"           => "file_user_image",
												"db_field"              => "user_image",
												"input_nick"            => "Profile Image",
												"hdn_field"             => "user_image",
												"tmp_table_field"       => "upload_1",
												"only_validate"			=> FALSE,
												"is_multiple"           => FALSE);
	
	
				$config_image       = array("upload_path"               => $this->data["images_dir"],
											"allowed_mimes"             => $this->data['images_mimes'],
											"images_types"            	=> $this->data['images_types'],
											"encrypt_name"              => TRUE);

				$config_thumb       = array();
	
	
				
				$tmp_upload_image_1 = GeneralHelper::upload_image($request, $validator, $config_image, $config_thumb, $other_upload);
				
				#$validator          = $tmp_upload_image_1['validator'];
	
				$this->tmp_record_uploads_in_db($request, FALSE, $tmp_upload_image_1  );
		
			}
		}
		

		
		return array("validator"	=>  $validator, 
					"image_data" 	=> array(	"other_upload" 		=> $other_upload, 
												"upload_image_data" => $tmp_upload_image_1) );

	}

	public function save_form( $request, $tmp_upload_image_1 = array(), $other_upload  = array() )
	{

		if ( $request->option == "update_credentials" )
		{
			$saveData								= \App\Models\Pilots::where("id", Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )->user()->id  )->get()->first();
			$saveData->email						= $request->email;
			$saveData->password						= \Hash::make($request->confirm_password);
			$saveData->save();	


			$user = Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )-> setUser($saveData);
		}
		else  if ( $request->option == "change_password" )
		{
			$saveData								= \App\Models\Pilots::where("id", Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )->user()->id  )->get()->first();
			
			$saveData->password						= \Hash::make($request->new_password);
			$saveData->save();	


			$user = Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )->  setUser($saveData);
		}
		else  if ( $request->option == "update_hub_and_rank" )
		{
			$saveData								= \App\Models\Pilots::where("id", Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )->user()->id   )->get()->first();
			
			$saveData->hub_id						= $request->hub_id;
			$saveData->rank_id						= $request->rank_id;

			$saveData->save();	


			$user = Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )->  setUser($saveData);
		}
		else {

			$saveData								= new \App\Models\Pilots();		
			
			if ( $request->option == "edit" )
			{
				$saveData							= \App\Models\Pilots::where("id", Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )->user()->id  )->get()->first();
			}
			else
			{
				$saveData->user_image				= "";	
			}
		
		
			$saveData->first_name						= $request['first_name'];
			$saveData->last_name						= $request['last_name'];
			$saveData->bio								= $request['bio'];
			$saveData->call_sign						= $request['call_sign'];
			$saveData->number_flights					= $request['number_flights'];
			$saveData->notifications					= $request['notifications'];

			$saveData->vatsim_id						= $request['vatsim_id'];
			$saveData->rank_id							= $request['rank_id'];

			if ( $tmp_upload_image_1["error"] == 1 || $tmp_upload_image_1["error"] == 2 )
			{
				$saveData->user_image				= $tmp_upload_image_1["hdn_array"][$other_upload["hdn_field"]];	;
			}
		
		

			$saveData->save();	


			$user = Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )->  setUser($saveData);

			return $user;
			// Auth::guard( RoleManagement::get_current_user_logged_in_GUARD())->loginUsingId();
		}
	}


	public function save(Request $request)
	{
	

		$this->data['_pageview']              	= $this->data["_directory"] . "edit";
		$this->data['option']                 	= $request->option;

		
		$_validate_form_data 					= $this->validate_form( $request );
		$validator 								= $_validate_form_data["validator"];
		$other_upload 							= $_validate_form_data["image_data"]["other_upload"];
		$tmp_upload_image_1 					= $_validate_form_data["image_data"]["upload_image_data"];

		if ($validator->fails()) {
			
			if($request->ajax()){

				$tmp_array = $this->setup_ajax_response(false, trans("general_lang.operation_error_save"), $validator->messages());

				echo json_encode($tmp_array);
				exit();
			}
			else {
				$this->data['_messageBundle']                       = $this->_messageBundle('danger', trans("general_lang.operation_error_save"), '');
				return view($this->constants["SITECONTROL_TEMPLATE"], $this->data)->with("errors", $validator->messages());
			}
			

		} else {
			
			$this->save_form($request, $tmp_upload_image_1, $other_upload);

			if($request->ajax()){

				$tmp_array = $this->setup_ajax_response(true, 'Record Updated', array());
				echo json_encode($tmp_array);
				exit();
			}
			else {
				
				
			}
			
			
			$this->data['_messageBundle']		    = $this->_messageBundle(' alert-success alert', trans("general_lang.operation_saved_success"), trans("general_lang.heading_operation_success"), false, true);
		}

		return redirect( $this->data["_directory"] . "edit/" . Auth::guard(  RoleManagement::get_current_user_logged_in_GUARD() )->ID() ) ;
	}

	

}