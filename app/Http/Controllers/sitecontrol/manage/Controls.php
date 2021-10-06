<?php

namespace App\Http\Controllers\sitecontrol\managepilots;

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
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;

class Controls extends MY_controller
{
	function __construct()
	{
		parent::__construct();

		$this->data                                             = $this->default_data();

		$this->data["_heading"]                                 = "Pilots";

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
		$this->data["_directory"]                               = $this->data['admin_path'] . "managepilots/";
		$this->data['_pageview']                                = $this->data["_directory"] . "view";
		$this->data["_Add_Text"]								= "Add Pilot";



		$this->data["images_types"]								= "gif,jpg,png,jpeg";
		$this->data["images_mimes"]								= "image/jpeg,image/gif,image/jpg,image/png";
		$this->data["images_dir"]								= "assets/uploads/user_images/";


		$this->input_fields	 									= ['pilot_role_id', 'notifications', 'first_name', 'last_name', 'email', "bio", "call_sign", "number_flights|default_zero", "vatsim_id|default_zero", "user_image", 'id', 'option']; #'images_types|images_types'
		$this->fillable_inputs 									= ['pilot_role_id', 'notifications', 'first_name', 'last_name', 'email', "bio", "call_sign", "number_flights", "vatsim_id", "user_image", 'id', 'option']; #, 'images_types'

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
		$tmp_query          = Pilots::query()->where("id", "!=", Auth::guard(RoleManagement::get_current_user_logged_in_GUARD())->user()->id);



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

		#remove record from DETAIL table

		foreach ($request->checkbox_options	as $key	=> $result) {

			$RECORD_details   = \App\Models\Pilots::where("id", $result);

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

		$_records											= Pilots::where("id", $edit_id);

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

				"first_name"				=> "required",
				"last_name"					=> "required",
				#"email"						=> "required|email|unique:pilots",
				"password"					=> "trim",
				"pilot_role_id"				=> "required",

				"bio"                		=> "trim",
				"call_sign"                	=> "trim",
				"number_flights"          	=> "trim|integer",
				"vatsim_id"                	=> "trim|integer",
				"notifications"        		=> "trim",
			];



			$tmp_validate_EMAIL					= $this->find_duplicate_values(Pilots::where("email", $request["email"]), $request["id"]);

			$tmp_validate["email"]				= "required|email|duplicate:" . $tmp_validate_EMAIL;


			if ($request->id == "") {
				$tmp_validate["password"] = "required|min:6";
			}

			$validator = Validator::make($request->all(), $tmp_validate);


			$input_labelName = array(
				"first_name"				=> "First Name",
				"last_name"					=> "Last Name",
				"email"						=> "Email",
				"password"					=> "Password",
				"pilot_role_id"				=> "Role",

				"bio"                		=> "Bio",
				"call_sign"                	=> "Call Sign",
				"number_flights"          	=> "Number Flights",
				"vatsim_id"                	=> "Vatsim ID",
				"notifications"        		=> "Notifications",

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



				$tmp_upload_image_1 = GeneralHelper::upload_image($request, $validator, $config_image, $config_thumb, $other_upload);

				#$validator          = $tmp_upload_image_1['validator'];

				$this->tmp_record_uploads_in_db($request, FALSE, $tmp_upload_image_1);
			}
		}



		return array(
			"validator"	=>  $validator,
			"image_data" 	=> array(
				"other_upload" 		=> $other_upload,
				"upload_image_data" => $tmp_upload_image_1
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

				$saveData								= new \App\Models\Pilots();

				if ($request->option == "edit") {
					$saveData							= \App\Models\Pilots::where("id", $request->id)->get()->first();
				} else {
					$saveData->user_image				= "";
				}



				$saveData->airline_id	 					= Auth::guard(RoleManagement::get_current_user_logged_in_GUARD())->user()->airline()->get()->first()->id;
				$saveData->pilot_role_id 					= $request['pilot_role_id'];
				$saveData->first_name						= $request['first_name'];
				$saveData->last_name						= $request['last_name'];

				$saveData->email 							= $request['email'];
				if ( $request->password == "" )
				{

				}
				else {
					$saveData->password							= Hash::make($request['password']);
				}
					
				$saveData->last_name						= $request['last_name'];

				$saveData->bio								= $request['bio'];
				$saveData->call_sign						= $request['call_sign'];
				$saveData->number_flights					= $request['number_flights'];
				$saveData->notifications					= $request['notifications'];

				$saveData->vatsim_id						= $request['vatsim_id'];

				if ($tmp_upload_image_1["error"] == 1 || $tmp_upload_image_1["error"] == 2) {
					$saveData->user_image					= $tmp_upload_image_1["hdn_array"][$other_upload["hdn_field"]];;
				}

				$saveData->join_date						= date("Y-m-d H:i:s");

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