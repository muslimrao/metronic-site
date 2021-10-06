<?php

namespace App\Http\Controllers\sitecontrol\manageflightshistory;

use Form;
use Validator;
use App\Models\Pilots;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use App\Http\Helpers\GeneralHelper;
use App\Http\Library\RoleManagement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MY_controller;
use App\Models\FlightHistory;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;

class Controls extends MY_controller
{
	function __construct()
	{
		parent::__construct();

		$this->data                                             = $this->default_data();

		$this->data["_heading"]                                 = "Flight History";

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
		$this->data['_controller']								= "manageflightshistory";

		$this->data["_directory"]                               = $this->data['admin_path'] . $this->data['_controller'] .  "/";
		$this->data['_pageview']                                = $this->data["_directory"] . "view";
		$this->data["_Add_Text"]								= "Add Flight History";



		$this->data["images_types"]								= "gif,jpg,png,jpeg";
		$this->data["images_mimes"]								= "image/jpeg,image/gif,image/jpg,image/png";
		$this->data["images_dir"]								= "assets/uploads/user_images/";


		$this->input_fields	 									= ['pilot_id', 'flight_number', 'aircraft_id', 'report', 'airport_depart|default_date', "airport_arrive|default_date", "route", "status", "flight_data", "landing_rate", 'miles', 'fuel','flight_time|default_minutes_seconds','passengers', 'id', 'option']; #'images_types|images_types'
		$this->fillable_inputs 									= ['pilot_id', 'flight_number', 'aircraft_id', 'report', 'airport_depart', "airport_arrive", "route", "status", "flight_data", "landing_rate", 'miles', 'fuel','flight_time','passengers', 'id', 'option']; #'images_types|images_types'

		GeneralHelper::form_fields_generator($this->data, false,  [], $this->input_fields, $this->fillable_inputs);
	}

	/**
	 * View all records function
	 * @param Request $request
	 * @param Builder $htmlBuilder
	 * @param string $view_filter
	 * @return void
	 */
	public function view(Request $request, Builder $htmlBuilder, string $view_filter = 'view')
	{


		if (!in_array($view_filter, ['view', 'trashed'])) {
			return GeneralHelper::show_error_page("404");
		}



		$tmp_query          = FlightHistory::whereHas('pilot', function( $query ){
			$query->where("airline_id", get_airline_ID());
			$query->whereIn("pilot_role_id", RoleManagement::get_pilot_ROLE_IDS_with_logged_in_ROLE_ID());

		});



		

		$tmp_query->orderBy('id', 'desc');

		
		$this->data['table_record']        					= $tmp_query;
		$this->data['view_filter']        					= $view_filter;

		if ($view_filter == 'trashed') {

			$this->data['table_record'] = $this->data['table_record']->onlyTrashed();
		}


		return view($this->constants["ADMINCMS_TEMPLATE_VIEW"], $this->data);
		/*
		if ($request->draw) {

			$datatables						= DataTables::eloquent($this->data["table_record"])

				->addColumn('id', function ($v) {

					return Form::checkbox('checkbox_options[]', $v->id, false, ['class' => '']);
				})
				->editColumn('sort', function ($v) {

					return Form::text('sort['. $v->id .']', $v->sort, ['class' => '', "style" => "width:70px;"]);
				})
				->addColumn('action', function ($v) {

					return Form::edit($this->data['_directory'], $v->id); 
				});
			return $datatables->make(true);
		} else {



			$html	= $htmlBuilder
				->addColumn(['data' => 'id', 'name' => 'id', 'title' => " " . Form::checkbox('select_all', '', false, array('class' => 'flat-red')), 'style' => "width:10px", "searchable" => false, "orderable" => false])
				->addColumn(['data' => 'title', 'name' => 'title', 'title' => trans("general_lang.label_txt_title"), "style" => "width:20%;"])
				->addColumn(['data' => 'description', 'name' => 'description', 'title' => trans("general_lang.label_txt_description")])
				->addColumn(['data' => 'sort', 'name' => 'sort', 'title' => trans("general_lang.label_txt_sort"), 'style' => "width:40px"])
				->addColumn(['data' => 'action', 'name' => 'action', 'title' => trans("general_lang.label_txt_action"), "searchable" => false, "orderable" => false, 'style' => "width:10px"]);

			$html->setTableAttributes(['class' => "table table-bordered table-striped", "id" => "tbl_records_serverside"]);

			$html->ajax(url("sitecontrol/managepilots/" . $view_filter));

			$html->parameters([
				"lengthMenu"			=> json_decode($this->data['dataTableLENGTH_PARENT']),
				'dom'	                => $this->data['dataTableDOM_PARENT'],
				'order'	 				=> array(1, "desc"),

				'fnPreDrawCallback'			=> "function(){

					//datatable_block_ui('show');				

				}",

				'drawCallback'		=> "function( settings ){
					
					// datatable_block_ui('hide');

					// render_icheckbox();
					// render_icheckbox_events();
					// selectize_inputs('selectize_datatable', 'readonly');
	
					
				}",


				'initComplete' => "function( settings, json  ){
					
									// disableSubmitForm_onDataTableSearch();
									// dataTableSearchOnEnterKey( 'serverside' );

									// var _self	 = this;

									// this.api().columns().every(function ( i, f ) {

									// 	var column = this;

									// });


							}",


			]);

			$this->data['html']				= $html;

			return view($this->constants["ADMINCMS_TEMPLATE_VIEW"], $this->data);
		}*/
	}

	/**
	 * View Details of records function
	 *
	 * @param Request $request 
	 * @return void
	 */
	public function details(Request $request)
	{
		$this->data['_pageview'] 		= $this->data["_directory"] . "edit";
		$this->data['class_name'] 		= 'form-control-plaintext';

		$id = $request->route('id');

		if (empty($id)) {
			return GeneralHelper::show_error_page("404");
		}

		$_records 										= $this->detail($request);

		if (empty($_records)) {
			return GeneralHelper::show_error_page("404");
		}
		$_records 				= $_records->toArray();
		$_records['option'] 	= 'detail';
		GeneralHelper::form_fields_generator($this->data, true, $_records, $this->input_fields, $this->fillable_inputs);

		return view($this->constants["ADMIN_TEMPLATE"], $this->data);
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
			case 'delete_selected':
				$this->_delete($request);
				break;


			case 'ajax_update_sorting':
				$this->_ajax_update_sorting($request);
				break;
		}

		$this->data['_messageBundle']		    = $this->_messageBundle(' alert-success alert', trans("general_lang.operation_delete_success"), trans("general_lang.heading_operation_success"), false, true);
		return redirect($this->data["_directory"] . "view");
	}

	/**
	 * delete records function
	 *
	 * @param Request $request
	 * @return void
	 */
	protected function _delete(Request $request)
	{

		if ( !RoleManagement::if_Allowed( $this->data['_controller'], 'delete' ) )
		{
			return GeneralHelper::show_error_page("401");
		}
		
		#remove record from DETAIL table
		foreach ($request->checkbox_options	as $key	=> $result) {

			$RECORD_details   = \App\Models\FlightHistory::where("id", $result);

			foreach ($RECORD_details->get() as $rd) {
				#$this->remove_file($rd->user_image);
			}


			$RECORD_details->delete();
		}
	}


	protected function _ajax_update_sorting(Request $request)
	{

		foreach ($request->sort as $id => $value) {

			$this->update_sorting($id, $value);
		}
	}


	/**
	 * Create record view function
	 *
	 * @return void
	 */
	public function add()
	{

		$this->data['_pageview']                                = $this->data["_directory"] . "edit";
		$this->data['option']                                		= "add";

		return view($this->constants["ADMINCMS_TEMPLATE_VIEW"], $this->data);
	}


	/**
	 * Edit records view function
	 *
	 * @param $edit_id
	 * @return void
	 */
	public function edit($edit_id)
	{

		$_records											= FlightHistory::where("id", $edit_id);

		if ($_records->count() <= 0) {
			return GeneralHelper::show_error_page("404");
		}




		$this->data['_pageview']                                	= $this->data["_directory"] . "edit";
		$_records                                					= $_records->get()->first()->toArray();
		$_records['option']                                			= "edit";


		GeneralHelper::form_fields_generator($this->data, true,  $_records, $this->input_fields, $this->fillable_inputs);

		return view($this->constants["ADMINCMS_TEMPLATE_VIEW"], $this->data);
	}


	public function validate_form($request)
	{
		$other_upload = array();
		$tmp_upload_image_1 = array();


		if ($request->option == "test") {
			/*
			$tmp_validate_EMAIL								= $this->find_duplicate_values(\App\Models\Pilots::where("email", $request->email), Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )->user()->id);
		
			$TMP_validate["email"]							= "required|email|duplicate:" . $tmp_validate_EMAIL;
			$TMP_validate["confirm_password"]				= "required|min:8|currentloggedinpassword";

	
			
			$validator = Validator::make($request->all(), $TMP_validate);
	

			$input_labelName = array(
				'email'									=> "Email",
				'confirm_password'           			=> 'Confirm Password',			
			);
	
			$validator->setAttributeNames($input_labelName);
			*/
		} else {

			$tmp_validate = [
				"id"                    	=> "trim",
				"option"               	=> "trim",
				"unique_formid"         	=> "trim",

				"pilot_id"					=> "required",
				"flight_number"				=> "trim",
				"aircraft_id"					=> "trim",
				"report"					=> "trim",
				"airport_depart"			=> "trim",

				"airport_arrive"			=> "trim",
				"route"			=> "trim",
				"status"			=> "trim",
				"flight_data"			=> "trim",


				"landing_rate"                		=> "trim",
				"miles"                	=> "trim",
				"fuel"          	=> "trim",
				"flight_time"                	=> "trim|numeric",
				"passengers"        		=> "trim",
			];


			$validator = Validator::make($request->all(), $tmp_validate);


			$input_labelName = array(
				"pilot_id"					=> "Pilot",
				"flight_number"					=> "Flight Number",
				"aircraft_id"					=> "Aircraft",
				"report"					=> "Report",
				"airport_depart"			=> "Airport Depart",

				"airport_arrive"			=> "Airport Arrive",
				"route"			=> "Route",
				"status"			=> "Status",
				"flight_data"			=> "Flight Data",


				"landing_rate"                		=> "Landing Rate",
				"miles"                	=> "Miles",
				"fuel"          	=> "Fuel",
				"flight_time"                	=> "Flight Time",
				"passengers"        		=> "Passengers",

			);

			$validator->setAttributeNames($input_labelName);

		}



		return array(
			"validator"	=>  $validator,
			"image_data" 	=> array(
				"other_upload" 		=> $other_upload = array(),
				"upload_image_data" => $tmp_upload_image_1 = array()
			)
		);
	}


	/**
	 * save function is used to save data on edit / create
	 *
	 * @param Request $request
	 * @return void
	 */
	public function save(Request $request)
	{
		$this->data['_pageview']              = $this->data["_directory"] . "edit";
		$this->data['option']                 = $request->option;


		$_validate_form_data 					= $this->validate_form($request);
		$validator 								= $_validate_form_data["validator"];
		$other_upload 							= $_validate_form_data["image_data"]["other_upload"];
		$tmp_upload_image_1 					= $_validate_form_data["image_data"]["upload_image_data"];


		if ($validator->fails()) {


			if ($request->ajax()) {

				$tmp_array = $this->setup_ajax_response(false, trans("general_lang.operation_error_save"), $validator->messages());

				echo json_encode($tmp_array);
				exit();
			} else {
				$this->data['_messageBundle']                       = $this->_messageBundle('danger', trans("general_lang.operation_error_save"), '');

				return view($this->constants["SITECONTROL_TEMPLATE"], $this->data)->with("errors", $validator->messages());
			}
		} else {

			$isError = $this->save_form($request, $tmp_upload_image_1, $other_upload);
			
			if ( $isError instanceof \Illuminate\Http\RedirectResponse) 
			{
				return $isError;
			}

			
			if ($request->ajax()) {

				$tmp_array = $this->setup_ajax_response(true, trans("general_lang.operation_saved_success"), array());

				echo json_encode($tmp_array);
				exit();
			} else {
			}

			$this->data['_messageBundle']		    = $this->_messageBundle(' alert-success alert', trans("general_lang.operation_saved_success"), trans("general_lang.heading_operation_success"), false, true);
		}

		return redirect($this->data["_directory"] . "view");
	}



	public function save_form($request, $tmp_upload_image_1 = array(), $other_upload  = array())
	{

		try {
			
			if ($request->option == "test") {

				// $saveData								= \App\Models\Pilots::where("id", Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )->user()->id  )->get()->first();
				// $saveData->email						= $request->email;
				// $saveData->password						= \Hash::make($request->confirm_password);
				// $saveData->save();	


				// $user = Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )-> setUser($saveData);
			} else {

				$saveData								= new \App\Models\FlightHistory();

				if ($request->option == "edit") {
					$saveData							= \App\Models\FlightHistory::where("id", $request->id)->get()->first();
				} else {
					
				}


				$saveData->pilot_id 	 					= $request['pilot_id'];
				$saveData->flight_number 					= $request['flight_number'];
				$saveData->aircraft_id						= $request['aircraft_id'];
				$saveData->report						= $request['report'];
				$saveData->airport_depart 							= GeneralHelper::format_date( $request['airport_depart'] , "Y-m-d");
				$saveData->airport_arrive						= GeneralHelper::format_date( $request['airport_arrive'], "Y-m-d");
				$saveData->route								= $request['route'];
				$saveData->status						= $request['status'];
				$saveData->flight_data					= $request['flight_data'];
				$saveData->landing_rate					= $request['landing_rate'];
				$saveData->miles						= $request['miles'];
				$saveData->fuel						= $request['fuel'];
				$saveData->flight_time						= $request['flight_time'];
				$saveData->passengers						= $request['passengers'];

				$saveData->save();




				return $saveData;
				// Auth::guard( RoleManagement::get_current_user_logged_in_GUARD())->loginUsingId();
			}
		} catch (QueryException		$ex) {
			
		
			$this->_messageBundle('danger', $ex->getMessage(), '', FALSE, TRUE);
			return redirect($this->data["_directory"] . "view");

			
		}
	}
}