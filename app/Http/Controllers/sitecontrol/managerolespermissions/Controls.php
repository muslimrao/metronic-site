<?php

namespace App\Http\Controllers\sitecontrol\managerolespermissions;

use Form;
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
use App\Http\Helpers\DropdownHelper;
use App\Models\RolePermissions;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;

class Controls extends MY_controller
{
	function __construct()
	{
		parent::__construct();

		$this->data                                             = $this->default_data();

		$this->data["_heading"]                                 = "Role Permissions";

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
		$this->data["_directory"]                               = $this->data['admin_path'] . "managerolespermissions/";
		$this->data['_pageview']                                = $this->data["_directory"] . "view";
		$this->data["_Add_Text"]								= "Add Pilot";



		$this->data["images_types"]								= "gif,jpg,png,jpeg";
		$this->data["images_mimes"]								= "image/jpeg,image/gif,image/jpg,image/png";
		$this->data["images_dir"]								= "assets/uploads/user_images/";


		$this->input_fields	 									= ["redirect_after_login", "id", 		 "pilot_role_id", 'id', 'option']; #'images_types|images_types'
		$this->fillable_inputs 									= ["redirect_after_login", "id", 		 "pilot_role_id", 'id', 'option']; #, 'images_types'

		GeneralHelper::form_fields_generator($this->data, false,  [], $this->input_fields, $this->fillable_inputs);

        $this->_create_child_for_form(FALSE, $this->data, array() );


		$this->data['_left_pages_array']                        = $this->_left_pages();
		$this->data['redirect_after_login_dropdown']			= DropdownHelper::runtime_dropdown( GeneralHelper::role_permissions_left_pages(TRUE), array("value" => "text", "key" => "directory"), "Select Page");

		$this->data['_already_roles_added']						= RolePermissions::select('pilot_role_id')->distinct()->pluck("pilot_role_id")->all();

		

	}

	public function _create_child_for_form( $return_array = false, &$data, $db_data = array() )
    {
        $empty_inputs				= array("directory", "operation");

        $filled_inputs				= array("directory", "operation");



        if ($return_array == true)
        {
            for ($x=0;  $x < count($empty_inputs); $x++)
            {

                #$data[ $empty_inputs[$x] ]					= array();
            }



            for ($x=0;  $x < count($empty_inputs); $x++)
            {
                for ($m=0; $m < count($db_data); $m++)
                {

                    if ( array_key_exists($empty_inputs[$x] , $db_data[$m]) )
                    {
						if ( $db_data[$m][ 'extra_condition' ] != "" )
						{
							$EXTRA_CONDITION = unserialize( $db_data[$m][ 'extra_condition'] );
							if ( !is_array($EXTRA_CONDITION) )
							{
								$EXTRA_CONDITION	= $db_data[$m][ 'extra_condition'];
							}
							
							$data['tableArray'][ $db_data[$m][ 'directory' ] ]['extra_condition'][ $db_data[$m][ 'operation' ] ]	= $EXTRA_CONDITION;
						}
						else
						{
                        	$data['tableArray'][ $db_data[$m][ 'directory' ] ][ $db_data[$m][ 'operation' ] ]	= 1;
						}
                    }
                }
            }


        }
        else
        {
			$db_data			= $this->_left_pages();
			
		
            for ($x=0;  $x < count($empty_inputs); $x++)
            {
			
				
				
				
				for ($m=0; $m < count( $db_data ); $m++)
				{
					foreach (GeneralHelper::role_permissions_operations() as $ooo)
					{
						$data['tableArray'][ $db_data[$m][ 'directory' ] ][$ooo] = array();
					}
					
				
					
					
					if ( array_key_exists("extra_conditions", $db_data[$m] ) )
					{
						foreach ($db_data[$m]['extra_conditions'] as $condition )
						{
							$data['tableArray'][ $db_data[$m]['directory'] ]['extra_condition'][ $condition['key'] ]			= 0;
						}
						
					}
				}
				
                
            }
		
        }


		
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


		$this->data["table_record"]               = RolePermissions::select( "pilot_role_id");
		

	
		$this->data["table_record"]->groupBy("pilot_role_id");


		$this->data["table_record"]					= $this->data["table_record"];



	
  
		return view($this->constants["ADMINCMS_TEMPLATE_VIEW"], $this->data);
		
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
		return redirect( route( "managerolespermissions.view"  ));
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

		
			$RECORD_details   = \App\Models\RolePermissions::where("pilot_role_id", $result);

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

		
		$this->data['_pageview']                                    = $this->data["_directory"] . "edit";
        $this->data["edit_id"]                                      = $edit_id;

	
        $_USER_DETAILS                                          	= RolePermissions::where("pilot_role_id", $edit_id);
		
		
        if ( $_USER_DETAILS -> count() <= 0 )
        {
            return GeneralHelper::show_error_page("404");
        }


        
        
		$TMP_data										= $_USER_DETAILS->get()->first()->toArray();
        $TMP_data['redirect_after_login']				= "";
		
		
		$tmp_where										= array('pilot_role_id'		=> $edit_id,
																// 'project_id'			=> $TMP_project_id,
																'operation'				=> 'redirect_after_login');	
		$_redirect_to									= RolePermissions::where( $tmp_where );
		if ( $_redirect_to -> count() > 0 )
		{
			$TMP_data['redirect_after_login']			= $_redirect_to->get()->first()->directory;
		}
		
		
        
      	$TMP_data["option"]							= "edit";
		$TMP_data["unique_formid"]						= "";

		GeneralHelper::form_fields_generator($this->data, true,  $TMP_data, $this->input_fields, $this->fillable_inputs);
        $this->_create_child_for_form(true, $this->data, $_USER_DETAILS->get()->toArray() );

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

			// $tmp_validate_PROJECTID				= $this->if_value_already_exists( RolePermissions::where("pilot_role_id", $request["pilot_role_id"]), $request["pilot_role_id"], "project_id");		
		
			// if ( $request['options'] == "edit" )
			// {
			// 	$tmp_validate_PROJECTID			= TRUE;
			// }
		
		
		
			$tmp_validate_PROJECTID				= $this->if_value_already_exists( 	RolePermissions::where("pilot_role_id", $request["pilot_role_id"]), 
																					$request["pilot_role_id"], 
																					"pilot_role_id");		

			if ( $request['option'] == "edit" )
			{
				$validator = Validator::make($request->all(), [
					"pilot_role_id"                    		=> "required",
	
				]);
			}

			else {

				$validator = Validator::make($request->all(), [
					"pilot_role_id"                    		=> "required|unique:roles_permissions",
	
				]);
			}
			
			


			$input_labelName = array(
				//"general.parent_id"                 	=> "Parent Category",
				"pilot_role_id"                      		=> "Pilot Role",			

			);

			$validator->setAttributeNames($input_labelName);
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

		return redirect( route("managerolespermissions.edit", array("id"	=> $request->pilot_role_id))  );
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


				// if ( $request['option'] == "edit" )
				// {
				// 	#only show edit User id.
				// 	$this->data['projectroles_id']                              	= $request['projectroles_id'];
				// 	$this->data['listedUsers']                                  	= false;
				// }
				// else
				// {
				// 	#not show those users who are already added.
				// 	$this->data['listedUsers']                                  = $this->TMP_records;
				// }
				

				$deletedRows        = RolePermissions::where('pilot_role_id', $request->pilot_role_id )->delete();

            
				if ( $request->tableArray )
				{
					foreach ( $request->tableArray as $key => $value )
					{
						 
						 foreach( $value as $operation_key => $operation_value )
						 {
							
							 if ( $operation_key ==  "extra_condition" )
							 {
								 
								foreach ( $operation_value as $extracondition_key => $extracondition_value )
								{
									$RolesPermissions = new RolePermissions();
								 
									 $RolesPermissions->pilot_role_id         = $request->pilot_role_id;
									//  $RolesPermissions->project_id         		= $request->project_id;
									 $RolesPermissions->directory               = $key;
									 $RolesPermissions->operation               = $extracondition_key;
									 
									 if ( is_array($extracondition_value) )
									 {
										$RolesPermissions->extra_condition         = serialize( $extracondition_value );
									 }
									 else
									 {
										 $RolesPermissions->extra_condition         = $extracondition_value;
									 }
									 
									 $RolesPermissions->save();
								}
							 }
							 else
							 {
								 $RolesPermissions = new RolePermissions();
								 
								 $RolesPermissions->pilot_role_id       	= $request->pilot_role_id;
								//  $RolesPermissions->project_id            	= $request->project_id;
								 $RolesPermissions->directory               = $key;
								 $RolesPermissions->operation               = $operation_key;

								 $RolesPermissions->save();
							 }
						 }
					}
				}
				
			
				$RolesPermissions = new RolePermissions();
				
				$RolesPermissions->pilot_role_id         = $request->pilot_role_id;
				// $RolesPermissions->project_id            	= $request->project_id;
				$RolesPermissions->directory               = $request->redirect_after_login;
				$RolesPermissions->operation               = 'redirect_after_login';
				
				$RolesPermissions->save();
				









				return $RolesPermissions;
				// Auth::guard( RoleManagement::get_current_user_logged_in_GUARD())->loginUsingId();
			}
		} catch (QueryException		$ex) {
			
		
			$this->_messageBundle('danger', $ex->getMessage(), '', FALSE, TRUE);
			return redirect( "managerolespermissions.view" );

			
		}
	}
}