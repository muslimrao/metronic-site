<?php

namespace App\Http\Controllers\frontend;

use Form;
use Validator;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use App\Http\Helpers\GeneralHelper;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreCmsPagesRequest;
use App\Http\Controllers\MY_controller;
use App\Http\Library\RoleManagement;
use App\Models\Pilots;

class Site_Home extends  MY_controller{
	function __construct()
	{
		parent::__construct();
		

        $this->data                               = $this->default_data();
	
		
        $this->data['_pagetitle']                 = "Home";
		
		
	
	}

	function index()
	{

		
		return redirect(route('dashboard.view'));
		
		$this->data['_pageview']									=  $this->data["frontend_path"] . "home";	
		

		$this->data['out_great_team']								= Pilots::where('airline_id', get_airline_ID())->where("pilot_role_id", "!=", RoleManagement::get_role_id_with_name("registered_user"));

	
	
        return view( \Config::get('constants.FRONTEND_TEMPLATE_HOME_VIEW'), $this->data);
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

		$this->data['table_record']        				= CmsPage::query()->orderBy('id', 'desc');

		$this->data['view_filter']        					= $view_filter;

		if ($view_filter == 'trashed') {
			$this->data['table_record'] = $this->data['table_record']->onlyTrashed();
		}



		if ($request->draw) {
			$datatables						= DataTables::eloquent($this->data["table_record"])

				->addColumn('id', function ($v) {

					return Form::checkbox('checkbox_options[]', $v->id, false, ['class' => '']);
				})   

				->addColumn('action', function ($v) {

					return Form::edit($this->data['_directory'], $v->id); 
				});
			return $datatables->make(true);
		} else {



			$html										= $htmlBuilder
				->addColumn(['data' => 'id', 'name' => 'id', 'title' => " " . Form::checkbox('select_all', '', false, array('class' => 'flat-red')), 'style' => "width:10px", "searchable" => false, "orderable" => false])
				->addColumn(['data' => 'title', 'name' => 'title', 'title' => trans("general_lang.label_txt_title")])
				->addColumn(['data' => 'slug', 'name' => 'slug', 'title' => trans("general_lang.label_txt_slug")])
 				->addColumn(['data' => 'action', 'name' => 'action', 'title' => trans("general_lang.label_txt_action"), "searchable" => false, "orderable" => false, 'style' => "width:10px"]);

			$html->setTableAttributes(['class' => "table table-bordered table-striped", "id" => "tbl_records_serverside"]);

			$html->ajax(url("sitecontrol/managecmspages/" . $view_filter));

			$html->parameters([
				"lengthMenu"			=> json_decode($this->data['dataTableLENGTH_PARENT']),
				'dom'	                => $this->data['dataTableDOM_PARENT'],
				'order'	 				=> array(1, "desc"),

				'fnPreDrawCallback'			=> "function(){

					datatable_block_ui('show');				

				}",

				'drawCallback'		=> "function( settings ){
					
					datatable_block_ui('hide');


					render_icheckbox();
					render_icheckbox_events();
					selectize_inputs('selectize_datatable', 'readonly');
					/*
					$('.selectize_datatable').selectize({
						delimiter: ',',
						create: false,
					});
					*/
					
				}",


				'initComplete' => "function( settings, json  ){
					
									disableSubmitForm_onDataTableSearch();
									dataTableSearchOnEnterKey( 'serverside' );

									var _self	 = this;

									this.api().columns().every(function ( i, f ) {

										var column = this;
                                        if( i == 5 )
                                        {

                                        }
                                        else{

											if ( false )
											{
												var input = document.createElement('input');
												$(input).attr('placeholder', 'Search ' + $(_self).find('thead th').eq(i).html());
												$(input).addClass('form-control input-sm');

												$(input).appendTo($(column.footer()).empty())

												.on('keydown', function ( event ) {

													var keyCode = (event.keyCode ? event.keyCode : event.which);

													if ( keyCode  == 13 )
													{

														//var _re_escape_regex = new RegExp( '(\\' + [ '/', '.', '*', '+', '?', '|', '(', ')', '[', ']', '{', '}', '\\', '$', '^', '-' ].join('|\\') + ')', 'g' );
														//val.replace( _re_escape_regex, '\\$(this).val()' );


														//var val = escapeRegexDataTable($(this).val());

														var val = $.fn.dataTable.util.escapeRegex($(this).val());


														$(column.footer()).closest(\"tr\").find(\"input,select\").removeClass(\"selectedSearch\");
														$(input).addClass(\"selectedSearch\");

														column.search(val ? val : '', false, false).draw();
													}
												});
											}
                                        }

									});


							}",


			]);

			$this->data['html']				= $html;

			return view($this->constants["ADMIN_TEMPLATE"], $this->data);
		}
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
		switch($request->options){
			case 'delete':
				$this->_delete($request);
			break;
		}
		$this->data['_messageBundle']		    = $this->_messageBundle(' alert-success alert', trans("general_lang.operation_delete_success"), trans("general_lang.heading_operation_success"), false, true);
		return redirect(route('viewCmsPages'));
	}

 /**
	* delete records function
	*
	* @param Request $request
	* @return void
	*/
	protected function _delete(Request $request)
	{
		foreach($request->checkbox_options as $id){
			$this->delete($id);
		}
	}

	/**
	 * Create record view function
	 *
	 * @return void
	*/
	public function create()
	{

		$this->data['_pageview']                                = $this->data["_directory"] . "edit";
		$this->data['option']                                		= "add";

		return view($this->constants["ADMIN_TEMPLATE"], $this->data);
	}


	/**
	 * Edit records view function
	 *
	 * @param Request $request
	 * @return void
	 */
	public function edit(Request $request)
	{
		
		$_records 						= $this->detail($request);
		if (empty($_records)) {
			return GeneralHelper::show_error_page("404");
		}


		$this->data['_pageview']                                    = $this->data["_directory"] . "edit";  

		$_records                                										= $_records->toArray();
		$_records['option']                                					= "edit"; 

		GeneralHelper::form_fields_generator($this->data, true,  $_records, $this->input_fields, $this->fillable_inputs);
		
		return view($this->constants["ADMIN_TEMPLATE"], $this->data);
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

		$validation_rules  											= StoreCmsPagesRequest::getRules($request);
		$validator 												    	= Validator::make($request->all(), $validation_rules);

		if ($validator->fails()) {

			$this->data['_messageBundle']                       = $this->_messageBundle('danger', $validator->messages(), 'Error!');
			return view($this->constants["ADMIN_TEMPLATE"], $this->data);
		} else {


			if($request->option == "edit"){	
				$this->save_or_update($request,TRUE);
			} else {
				$this->save_or_update($request);
			}
			
			$this->data['_messageBundle']		    = $this->_messageBundle(' alert-success alert', trans("general_lang.operation_saved_success"), trans("general_lang.heading_operation_success"), false, true);
		}

		return redirect(route('viewCmsPages'));
	} 

}