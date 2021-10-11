<?php

namespace App\Http\Controllers\sitecontrol\managesitesettings;

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
use App\Models\Aircraft;
use App\Models\PilotRoles;
use App\Models\Ranks;

class Controls extends MY_controller
{
	function __construct()
	{
		parent::__construct();


		$this->data = $this->default_data();

		
		$this->data["_heading"]                                 = "Project Settings";

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
		$this->data['_controller']								= "managesitesettings";
		$this->data["_directory"]                               = $this->data['admin_path'] .  $this->data['_controller'] . "/";

		$this->data['_root_dir']								=  $this->data['_directory'];
		$this->data['_pageview']                                = $this->data["_directory"] . "view";

		$this->data["images_types"]								= "gif,jpg,png,jpeg";
		$this->data["images_mimes"]								= "image/jpeg,image/gif,image/jpg,image/png";
		$this->data["images_dir"]								= "assets/uploads/domain_images/";
		$this->data['_messageBundle_2']                       	= FALSE;
        


		$this->input_fields	 									= ['aircraft_name', 'rank_name', 'hours_to_rank', 'num_flights',   'airline_name', 'about', 'images_types|images_types',  'logo', 'currency_type','measurement_type','timezone', 'id','option'];
		$this->fillable_inputs 									= ['aircraft_name', 'rank_name', 'hours_to_rank', 'num_flights',   'airline_name', 'about', 'images_types',  'logo', 'currency_type','measurement_type','timezone', 'id','option'];

		GeneralHelper::form_fields_generator($this->data, false,  [], $this->input_fields, $this->fillable_inputs);









		$this->data['site_owner']				= Pilots::where("airline_id", get_airline_ID())->whereIn("pilot_role_id",  function( $query ){

			$query->select('id')
			->from(with(new PilotRoles())->getTable())
			->where('is_owner', 1);
		})->limit(1)->get()->first();


		$this->data['registered_users_count']		= Pilots::where("airline_id", get_airline_ID());
		$this->data['selected_aircrafts_count']		= FlightHistory::whereHas('pilot', function( $query )	{

																												$query->where("airline_id", get_airline_ID() );

																											})->select('aircraft_id')->distinct();

		$this->data['user_roles_count']				= PilotRoles::query();
		$this->data['ranks_count']					= Ranks::where("airline_id", get_airline_ID());





		$this->data['active_user_groups'] = $this->data['active_ranks'] = $this->data['active_aircraft'] = $this->data['active_overview'] = FALSE;


	}

	/**
	 * 
	 * @param Request $request
	 * @param Builder $htmlBuilder
	 * @param string $view_filter
	 * @return void
	 */
	public function view(Request $request, Builder $htmlBuilder)
	{
		
		// $_records											= Pilots::where("id", $pilot_id)->where("airline_id", get_airline_ID() );

		// if ($_records->count() <= 0) {
		// 	return GeneralHelper::show_error_page("404");
		// }



		$this->data['active_overview']			= TRUE;
		



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

		if ( $request->option == "managesitesettings.ranks_add" || $request->option == "managesitesettings.ranks_edit" )
		{
			
			$this->ranks_init();


			#$tmp_validate_EMAIL								= $this->find_duplicate_values(\App\Models\Pilots::where("email", $request->email), Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )->user()->id);
			// $TMP_validate["email"]							= "required|email|duplicate:" . $tmp_validate_EMAIL;
			$TMP_validate["rank_name"]							= "required";
			$TMP_validate["hours_to_rank"]						= "required";
			$TMP_validate["num_flights"]						= "required";

	
			
			$validator = Validator::make($request->all(), $TMP_validate);
	

			$input_labelName = array(
				'rank_name'									=> "Rank Name",
				'hours_to_rank'           			=> 'Hours to Rank',			
				'num_flights'           			=> 'Number of Flights',				
			);
	
			$validator->setAttributeNames($input_labelName);

		}
		else if ( $request->option == "managesitesettings.aircraft_add" || $request->option == "managesitesettings.aircraft_edit" )
		{
			
			$this->aircraft_init();


			#$tmp_validate_EMAIL								= $this->find_duplicate_values(\App\Models\Pilots::where("email", $request->email), Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )->user()->id);
			// $TMP_validate["email"]							= "required|email|duplicate:" . $tmp_validate_EMAIL;
			$TMP_validate["aircraft_name"]							= "required";

	
			
			$validator = Validator::make($request->all(), $TMP_validate);
	

			$input_labelName = array(
				'aircraft_name'									=> "Aircraft Name",
				
			);
	
			$validator->setAttributeNames($input_labelName);

		}

		
		// else if ( $request->option == "change_password" )
		// {
			
			
		// 	$TMP_validate["current_password"]				= "required|currentloggedinpassword";
		// 	$TMP_validate["new_password"]					= "required|min:8";
		// 	$TMP_validate["confirm_password"]				= "required|min:8";

	
			
		// 	$validator = Validator::make($request->all(), $TMP_validate);
	

		// 	$input_labelName = array(
		// 		'current_password'									=> "Current Password",
		// 		'new_password'           			=> 'New Password',			
		// 		'confirm_password'           			=> 'Confirm Password',			
		// 	);
	
		// 	$validator->setAttributeNames($input_labelName);

		// }
		// else if ( $request->option == "update_hub_and_rank" )
		// {
			
			
		// 	$TMP_validate["hub_id"]						= "required";
		// 	$TMP_validate["rank_id"]					= "required";

	
			
		// 	$validator = Validator::make($request->all(), $TMP_validate);
	

		// 	$input_labelName = array(
		// 		'hub_id'									=> "Hub",
		// 		'rank_id'           			=> 'Rank',			
		// 	);
	
		// 	$validator->setAttributeNames($input_labelName);

		// }
		else {
			
			$validator = Validator::make($request->all(), [
				
				"airline_name"			=> "required",
				"about"				=> "required",
				
			]);
	
	
			$input_labelName = array(
				'airline_name'									=> "Airline Name",
				'about'								=> "About Airline",
				
			);
	
			$validator->setAttributeNames($input_labelName);
	
	
	
			 
			if ( "IMAGE_UPLOAD" )
			{
				#|mimes:' . $config_controls['allowed_types']
				$other_upload       = array(    "validate"              => "required",
												"input_field"           => "file_logo",
												"db_field"              => "logo",
												"input_nick"            => "Airline Logo",
												"hdn_field"             => "logo",
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

		if ( $request->option == "managesitesettings.ranks_add" || $request->option == "managesitesettings.ranks_edit" )
		{
			
			$saveData								= new \App\Models\Ranks();

			if ($request->option == "managesitesettings.ranks_edit") {
				$saveData							= \App\Models\Ranks::where("id", $request->id)->get()->first();
			} else {
				
			}
		

			$saveData->airline_id						= get_airline_ID();
			$saveData->rank_name						= $request->rank_name;
			$saveData->hours_to_rank					= $request->hours_to_rank;
			$saveData->num_flights						= $request->num_flights;
			$saveData->save();	



		}
		else if ( $request->option == "managesitesettings.aircraft_add" || $request->option == "managesitesettings.aircraft_edit" )
		{
			
			


			$saveData								= new \App\Models\Aircraft();

			if ($request->option == "managesitesettings.aircraft_edit") {
				$saveData							= \App\Models\Aircraft::where("id", $request->id)->get()->first();
			} else {
				
			}
		

			$saveData->airline_id						= get_airline_ID();
			$saveData->aircraft_name						= $request->aircraft_name;
			$saveData->save();	



		}

		
		// else  if ( $request->option == "change_password" )
		// {
		// 	$saveData								= \App\Models\Pilots::where("id", Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )->user()->id  )->get()->first();
			
		// 	$saveData->password						= \Hash::make($request->new_password);
		// 	$saveData->save();	


		// 	$user = Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )->  setUser($saveData);
		// }
		// else  if ( $request->option == "update_hub_and_rank" )
		// {
		// 	$saveData								= \App\Models\Pilots::where("id", get_airline_ID()  )->get()->first();
			
		// 	$saveData->hub_id						= $request->hub_id;
		// 	$saveData->rank_id						= $request->rank_id;

		// 	$saveData->save();	


		// 	$user = Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )->  setUser($saveData);
		// }
		else {

			
			$saveData									= \App\Models\Airlines::where("id", get_airline_ID()  )->get()->first();
		
			$saveData->airline_name						= $request['airline_name'];
			$saveData->about							= $request['about'];
			$saveData->currency_type					= $request['currency_type'];
			$saveData->measurement_type					= $request['measurement_type'];
			$saveData->timezone							= $request['timezone'];


			if ( $tmp_upload_image_1["error"] == 1 || $tmp_upload_image_1["error"] == 2 )
			{
				$saveData->logo				= $tmp_upload_image_1["hdn_array"][$other_upload["hdn_field"]];	;
			}
		
		
			$saveData->save();				
			$request->session()->invalidate();





			return $saveData;
			// Auth::guard( RoleManagement::get_current_user_logged_in_GUARD())->loginUsingId();
		}
	}


	public function save(Request $request)
	{
	

		if ( $request->option == "managesitesettings.ranks_add" || $request->option == "managesitesettings.ranks_edit")
		{
			$this->data['_pageview']              	= $this->data["_directory"] . "ranks/edit";
		}
		else if ( $request->option == "managesitesettings.aircraft_add" || $request->option == "managesitesettings.aircraft_edit")
		{
			$this->data['_pageview']              	= $this->data["_directory"] . "aircraft/edit";
		}
		else
		{
			$this->data['_pageview']            = $this->data["_directory"] . "edit";
		}
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

				$tmp_array = $this->setup_ajax_response(true, trans("general_lang.operation_saved_success"), array());
				
				echo json_encode($tmp_array);
				exit();
			}
			else {
				
				
			}
			
			
			$this->data['_messageBundle']		    = $this->_messageBundle(' alert-success alert', trans("general_lang.operation_saved_success"), trans("general_lang.heading_operation_success"), false, true);
		}



		if ( $request->option == "managesitesettings.ranks_add" || $request->option == "managesitesettings.ranks_edit")
		{
			$this->data['_controller']								= "managesitesettings/ranks";
			$this->data["_directory"]                               = $this->data['admin_path'] .  $this->data['_controller'] . "/";

			return redirect( route('managesitesettings.ranks.view')  );
		}
		else if ( $request->option == "managesitesettings.aircraft_add" || $request->option == "managesitesettings.aircraft_edit")
		{
			$this->aircraft_init();

			return redirect( route('managesitesettings.aircraft.view') );
		}
		
		else {

			return redirect( $this->data["_directory"] . "edit/" . Auth::guard(  RoleManagement::get_current_user_logged_in_GUARD() )->ID() ) ;
		}
	}

	/**
	 * option use to delete and other option function
	 *
	 * @param Request $request
	 * @return void
	 */
	public function options(Request $request)
	{


		switch ($request->option) {
			case 'delete_selected_ranks':
				$this->_delete_ranks($request);
				break;

			case 'delete_selected_aircraft':
				$this->_delete_aircraft($request);
				break;
		
		}

		$this->data['_messageBundle']		    = $this->_messageBundle(' alert-success alert', trans("general_lang.operation_delete_success"), trans("general_lang.heading_operation_success"), false, true);


		if ( $request->option == "delete_selected_ranks")
		{
			$this->data['_controller']								= "managesitesettings/ranks";
			$this->data["_directory"]                               = $this->data['admin_path'] .  $this->data['_controller'] . "/";		
			return redirect( route('managesitesettings.ranks.view') );
		}
		else if ( $request->option == "delete_selected_aircraft")
		{
			$this->data['_controller']								= "managesitesettings/aircraft";
			$this->data["_directory"]                               = $this->data['admin_path'] .  $this->data['_controller'] . "/";		

			return redirect( route('managesitesettings.aircraft.view') );
		}
		else {
			return redirect($this->data["_directory"] . "view");

		}
	}

	protected function _delete_ranks(Request $request)
	{
		$this->ranks_init();


		if ( !RoleManagement::if_Allowed( $this->data['_controller'], 'delete' ) )
		{
			return GeneralHelper::show_error_page("401");
		}

		
		#remove record from DETAIL table
		foreach ($request->checkbox_options	as $key	=> $result) {

			$RECORD_details   = \App\Models\Ranks::where("id", $result);

			foreach ($RECORD_details->get() as $rd) {
				#$this->remove_file($rd->user_image);
			}


			$RECORD_details->delete();
		}
	}

	protected function _delete_aircraft(Request $request)
	{

		$this->aircraft_init();
		
		if ( !RoleManagement::if_Allowed( $this->data['_controller'], 'delete' ) )
		{
			return GeneralHelper::show_error_page("401");
		}
		
		#remove record from DETAIL table
		foreach ($request->checkbox_options	as $key	=> $result) {

			$RECORD_details   = \App\Models\Aircraft::where("id", $result);

			foreach ($RECORD_details->get() as $rd) {
				#$this->remove_file($rd->user_image);
			}


			$RECORD_details->delete();
		}
	}


	
	protected function ranks_init()
	{
		$this->data["_heading"]                                 = "Ranks";
		$this->data['active_ranks']							= TRUE;
		$this->data['_controller']								= "managesitesettings/ranks";
		$this->data["_directory"]                               = $this->data['admin_path'] .  $this->data['_controller'] . "/";

	}


	public function ranks_view(Request $request, Builder $htmlBuilder)
	{	
		$this->ranks_init();

		$this->data['_pageview']     	= $this->data["_directory"] . "view";  
		$this->data['option']        	= "managesitesettings.ranks_view";


		$tmp_query          			= Ranks::query()->where("airline_id", get_airline_ID() );



		$tmp_query->orderBy('id', 'desc');

		$this->data['table_record']        					= $tmp_query;



		return view($this->constants["ADMINCMS_TEMPLATE_VIEW"], $this->data);
	}

	public function ranks_add()
	{
		$this->ranks_init();


		$this->data['_pageview']                                = $this->data["_directory"] . "edit";
		$this->data['option']                                	= "managesitesettings.ranks_add";

		return view($this->constants["ADMINCMS_TEMPLATE_VIEW"], $this->data);
	}

	public function ranks_edit($rank_id)
	{
		$this->ranks_init();


		$_records											= Ranks::where("id", $rank_id)->where("airline_id", get_airline_ID());

		if ($_records->count() <= 0) {
			return GeneralHelper::show_error_page("404");
		}


		#REFRESH DATA VARIABLES
		$this->input_fields	 									= ['rank_name', 'hours_to_rank', 'num_flights',   'id','option'];
		$this->fillable_inputs 									= ['rank_name', 'hours_to_rank', 'num_flights',   'id','option'];
		GeneralHelper::form_fields_generator($this->data, false,  [], $this->input_fields, $this->fillable_inputs);
		#REFRESH DATA VARIABLES




		$this->data['_pageview']                                	= $this->data["_directory"] . "edit";
		$_records                                					= $_records->get()->first()->toArray();
		$_records['option']                                			= "managesitesettings.ranks_edit";

		GeneralHelper::form_fields_generator($this->data, true,  $_records, $this->input_fields, $this->fillable_inputs);

		return view($this->constants["ADMINCMS_TEMPLATE_VIEW"], $this->data);
	}




	protected function aircraft_init()
	{
		$this->data["_heading"]                                 = "Aircraft";
		$this->data['active_aircraft']							= TRUE;
		$this->data['_controller']								= "managesitesettings/aircraft";
		$this->data["_directory"]                               = $this->data['admin_path'] .  $this->data['_controller'] . "/";

	}


	public function aircraft_view(Request $request, Builder $htmlBuilder)
	{		

		

		$this->aircraft_init();
		
		$this->data['_pageview']     		= $this->data["_directory"] . "view";  
		$this->data['option']        		= "managesitesettings.aircraft_view";


		$tmp_query          			= Aircraft::query()->where("airline_id", get_airline_ID() );



		$tmp_query->orderBy('id', 'desc');

		$this->data['table_record']        					= $tmp_query;



		return view($this->constants["ADMINCMS_TEMPLATE_VIEW"], $this->data);
	}

	public function aircraft_add()
	{
		$this->aircraft_init();
		

		
		$this->data['_pageview']                                = $this->data["_directory"] . "edit";
		$this->data['option']                                	= "managesitesettings.aircraft_add";

		return view($this->constants["ADMINCMS_TEMPLATE_VIEW"], $this->data);
	}

	public function aircraft_edit(Request $request, $aircraft_id)
	{

		$this->aircraft_init();

		$_records											= Aircraft::where("id", $aircraft_id)->where("airline_id", get_airline_ID());

		if ($_records->count() <= 0) {
			return GeneralHelper::show_error_page("404");
		}


		#REFRESH DATA VARIABLES
		$this->input_fields	 									= ['aircraft_name', 'id','option'];
		$this->fillable_inputs 									= ['aircraft_name', 'id','option'];
		GeneralHelper::form_fields_generator($this->data, false,  [], $this->input_fields, $this->fillable_inputs);
		#REFRESH DATA VARIABLES



		$this->data['_pageview']                                	= $this->data["_directory"] . "edit";
		$_records                                					= $_records->get()->first()->toArray();
		$_records['option']                                			= "managesitesettings.aircraft_edit";

		GeneralHelper::form_fields_generator($this->data, true,  $_records, $this->input_fields, $this->fillable_inputs);

		return view($this->constants["ADMINCMS_TEMPLATE_VIEW"], $this->data);
	}


}