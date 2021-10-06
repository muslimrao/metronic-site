$(document).ready(function(){


	render_textarea();



	if ( $(".date_picker").length > 0 )
	{
		$(".date_picker").datepicker(  { dateFormat: "dd-mm-yy" } );
	}

	if ( $('.date_picker_aftertoday') )
	{	
		$('.date_picker_aftertoday').datepicker({ minDate: 0, dateFormat: "dd-mm-yy" });
	}

	if ( $("input[data-datemode='start_1']").length > 0 && $("input[data-datemode='end_1']").length > 0 )
	{
		$("input[data-datemode='start_1']").datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			dateFormat: "dd-mm-yy",
			numberOfMonths: 2,
			onClose: function( selectedDate ) {
				$("input[data-datemode='end_1']").datepicker( "option", "minDate", selectedDate );
			}
		});
		
		
		$("input[data-datemode='end_1']").datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			dateFormat: "dd-mm-yy",
			numberOfMonths: 2,
			onClose: function( selectedDate ) {
				$("input[data-datemode='start_1']").datepicker( "option", "maxDate", selectedDate );
			}
		});
	}

	
	if ( $('.timepicker_range').length > 0 )
	{
		$('.timepicker_range').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'DD/MM/YYYY h:mm A'});
	}
	
	$('.timepicker').timepicker();




	


	$(".header-menu").each(function(){

		if ( CONTROLLER != "" )
		{
			$(".header-menu ").find("a").each (function(){

				var _url = $(this).attr("href").split("/");
				if ( jQuery.inArray(CONTROLLER, _url) !== -1 )
				{
					console.log(CONTROLLER);
					console.log($(this));
					console.log(_url);

					$(this).parent().addClass("here").closest("div.parent_nav ").addClass("here");	
				}

			
			});
		}
		else {
			$(".header-menu ").find("a[href='"+ window.location.href +"']").parent().addClass("here").parent().parent().addClass("here");

		}


		
		// var get_details = window.location.href.split("/");
		// if ( jQuery.inArray("edit", get_details) !== -1 )
		// {
			
		// 	$(".header-menu ").find("a").each (function(){

		// 		var _url = $(this).attr("href").split("/");
				
				
				
		// 		if ( jQuery.inArray(CONTROLLER, _url) !== -1 )
		// 		{
		// 			console.log(CONTROLLER);
		// 			console.log($(this));
		// 			console.log(_url);

		// 			$(this).parent().addClass("here").closest("div.parent_nav ").addClass("here");	
		// 		}

			
		// 	});

		// 	// $(".header-menu ").find("a[href='"+ window.location.href +"']").parent().addClass("here").parent().parent().addClass("here");
		// }
		// else
		// {
			
		// 	$(".header-menu ").find("a[href='"+ window.location.href +"']").parent().addClass("here").parent().parent().addClass("here");
		// }

	})

	$(document).on("change", "input[name='checkbox_options[]']", function(){
		toggleCheckBoxes();
	});

	$(document).on("change", "input[name='select_all']", function(){

		var ifChecked = $(this).prop("checked");

		if (  ifChecked )
		{
			$(this).closest("table").find("input[name='checkbox_options[]']").prop("checked", true);
		}
		else {
			$(this).closest("table").find("input[name='checkbox_options[]']").prop("checked", false);
		}


		toggleCheckBoxes();
	
	});
	
	
	$(document).on("click", ".form-submit-btn", function() {

		show_hide_loading_modal();
	} );
	
	$(document).on("click", " span[data-kt-image-input-action='remove']", function(e){
	
		var hiddenInputName = $(this).parent().find("input[type='file']").attr("data-hidden-input");
		if ( hiddenInputName )
		{
			var abc = $(this).parent().find("input[name='"+hiddenInputName  +"']").val("");
			console.log(abc);
		}
	})
	
	
	$(document).on("click", ".submit_btn_form", function(){
			
			
		var operation			= $(this).attr("data-operation");
		
		if ( operation == "delete" || operation == "delete_rank" || operation == "delete_aircraft" )
		{
			var this_form = $(this);
			
			
			show_confirm_delete(function(){
				
				
				show_hide_loading_modal();
				
				if ( operation == "delete_rank")
				{
					$("input[name='option']").val( "delete_selected_ranks" );
				}
				else if ( operation == "delete_aircraft")
				{
					$("input[name='option']").val( "delete_selected_aircraft" );
				}
				else {
					
					$("input[name='option']").val( "delete_selected" );
				}


				this_form.closest("table").find("input[name='checkbox_options[]']").prop("checked", false);
				this_form.closest("tr").find("input[name='checkbox_options[]']").prop("checked", true);

				this_form.closest("form").submit();
			}, function(){
				
			})			
			
		}
		else if ( operation == "delete_selected" || operation == "delete_selected_ranks" || operation == "delete_selected_aircraft")
		{
			var this_form = $(this);
			
			show_confirm_delete(function(){
				
				
				show_hide_loading_modal();
				
				$("input[name='option']").val( operation );
				this_form.closest("form").submit();
				


			}, function(){

			
				
				/*Swal.fire({
				text: "Selected customers was not deleted.",
				icon: "error",
				buttonsStyling: false,
				confirmButtonText: "Ok, got it!",
				customClass: {
					confirmButton: "btn fw-bold btn-primary",
				}
			});*/

			});
		}
		else if ( operation == "edit_record")
		{
			show_hide_loading_modal();

			// var _form = $(this).closest("form");
			// var _ajax_request_btn = $(this);
			// var pars = '';
			// var target = '#...';
			var this_site = $(this).attr("data-controller");
			var url = this_site;
		
		
			$.ajax({
				type: "GET",
				url: url,
				data: "",
				success: function (response) {
		

					// submit_action(response, target, '.targetDIV', _ajax_request_btn);
		
				}
		
			});
		
		}
		else if ( operation == "jQuery_edit_with_jstree" )
		{
			if ( $(".load_category_treeview").jstree(true).get_selected().length > 0 )
			{
				window.location = $(this).attr("data-href") + "/" + $(".load_category_treeview").jstree(true).get_selected();
			}
			else
			{
				_show_alert( 'red', 'Invalid Menu Selection.', 'Please select Menu');	
			}
		}
		
	
		
		
		
		else if ( operation == "copy" )
		{
			$("input[name='option']").val( operation );
			
			var copy_id		= $(this).parent().parent().find('input[type="checkbox"]').val();
			var input		= $( document.createElement('input') );	
			input.css('display', 'none');
			input.attr("name", "copy_id");
			input.val( copy_id );
			
			var copy_content_input = $( document.createElement('input') );
			copy_content_input.attr("type", "hidden");
			copy_content_input.attr("name", "copy_content");
			copy_content_input.val( "0" );
			
			var conf_id_input = $( document.createElement('input') );
			conf_id_input.attr("type", "hidden");
			conf_id_input.attr("name", "conf_id");
			conf_id_input.val( "0" );
			
			// confirm content copy
			if ( !$( this ).hasClass( "con" ) ) {
				
				$( "#dialog-confirm-yes-no" ).dialog({
					resizable: false,
					modal: true,
					buttons: {
						"Yes": function() {
							
							$( this ).dialog( "close" );
							
							// select conference
							$( "#dialog-select-conference" ).dialog({
								resizable: false,
								modal: true,
								buttons: {
									"Confirm": function() {
	
										conf_id_input.val( $('select[name="dialogconfid"]').val() );
										$( this ).dialog( "close" );
										
										// confirm content copy
										$( "#dialog-confirm-content-copy" ).dialog({
											resizable: false,
											modal: true,
											buttons: {
												"Yes": function() {
													
													copy_content_input.val( "1" );
													$( this ).dialog( "close" );
													
													$(".box-body.table-responsive form").append( input );
													$(".box-body.table-responsive form").append( copy_content_input );
													$(".box-body.table-responsive form").append( conf_id_input );
													
													$(".box-body.table-responsive form").submit();
													
													
												},
												"No": function() {
													
													copy_content_input.val( "0" );
													$( this ).dialog( "close" );
													
													$(".box-body.table-responsive form").append( input );
													$(".box-body.table-responsive form").append( copy_content_input );
													$(".box-body.table-responsive form").append( conf_id_input );
													
													$(".box-body.table-responsive form").submit();
													
												}
											},
											close: function() {
												$( this ).dialog( "close" );
											}
										});
										
									}
								}
							});
						},
						"No": function() {
							$( this ).dialog( "close" );
						}
					}
				});
				
			} else {
				
				$(".box-body.table-responsive form").append( input );
				$(".box-body.table-responsive form").append( copy_content_input );
				$(".box-body.table-responsive form").append( conf_id_input );
				
				$(".box-body.table-responsive form").submit();
				
			}
		}
		else if ( operation == "ajax_save_record" )
		{
			$("input[name='option']").val( operation );
			
			$("textarea[name='update_textboxes']").val( $("textarea[name='update_textboxes']").val().substr(1) );
			
			$("table#tbl_records_serverside textarea").not(  $( $( "textarea[name='update_textboxes']" ).val() )  ).prop("disabled", true);
			
			$("textarea[name='update_textboxes']").prop("disabled", false);
			
			
			$(".box-body.table-responsive form").submit();
		}
		else if ( operation == "ajax_update_sorting" )
		{
			$("input[name='option']").val( operation );
			
			$(".box-body.table-responsive form").submit();
		}
		else if ( operation == "ajax_download_csv" )
		{
			$("input[name='option']").val( operation );
			
			$(".box-body.table-responsive form").submit();
		}
		
	});
	


	$("body").on("click", ".btn_Ajax_Request", (function (e) {

		e.preventDefault();

		show_hide_loading_modal();





		var _form = $(this).closest("form");
		var this_site = _form.attr("action");
		var url = this_site;
		var fd = new FormData( _form[0] );

		if ( EDITORS.count > 0 )
		{
			fd.append("about", EDITORS["about"].getData());
		}

		

		$.ajax({

			/*type: "POST",
			url: url,
			data: _form.serialize(),*/

			type: "POST",
				data:  fd,
				contentType: false,
				cache: false,
				processData:false,
				url: url,


			success: function (response) {

				show_hide_loading_modal(false);
				_form.find("input").removeClass("is-invalid").removeClass("is-valid");
				_form.find(".fv-plugins-message-container").html( '' );

				
				var jsonResponse = JSON.parse( response );
				
				
				if ( jsonResponse.status )
				{
					show_alert(jsonResponse.message, "success", "Ok, got it!", "btn-primary", function(){

						if (jsonResponse.identifier == 'reload_page')
						{
							show_hide_loading_modal();
							
							window.location.reload();
						}


					});
				}
				else {

					
					
					show_errors_under_inputs(jsonResponse.data, _form, function(){

						show_alert(jsonResponse.message, "error", "Ok, got it!", "btn-danger");

					})
					
					
				}

			}

		});



		return false;

	}));
	
	
	$("body").on("click", ".btn_Ajax_Request", (function (e) {
	 /*
		e.preventDefault();
	
	
	
		var _form = $(this).closest("form");
		var this_site = _form.attr("action");
		var url = this_site;
		var pars = '';
		var target = '#...';
		var _ajax_request_btn = $(this);
	
	
		$.ajax({
			type: "POST",
			url: url,
			data: _form.serialize() + "&" + $(this).attr("name") + "=1",
			success: function (response) {
	
				submit_action(response, target, '.targetDIV', _ajax_request_btn);
	
			}
	
		});
	
	
		return false;
	*/
	}));
});



	
function show_hide_loading_modal( isShow = true )
{
	if ( isShow )
	{

		Swal.fire({
			title: 'Please Wait !',
			html: '',// add html attribute if you want or remove
			allowOutsideClick: false,
			showConfirmButton: false,
			didRender: () => {
			
				Swal.showLoading()
			},
		});
	}
	else {
		Swal.closeModal();
	}
}

function toggleCheckBoxes()
{
	if ( $("input[name='checkbox_options[]']:checked").length > 0 )
	{
		$("div[data-kt-user-table-toolbar='selected']").removeClass("d-none");
		$("div[data-kt-user-table-toolbar='base']").addClass("d-none");

		$("div[data-kt-user-table-toolbar='selected'] span[data-kt-user-table-select='selected_count']").html(  $("input[name='checkbox_options[]']:checked").length );

	}
	else {
		$("div[data-kt-user-table-toolbar='selected']").addClass("d-none");
		$("div[data-kt-user-table-toolbar='base']").removeClass("d-none");
	}
}


function show_errors_under_inputs( data, _form, failure_callback = () => {} )
{
	
	var _errors = JSON.parse( data );


	
	for (let [key, value] of Object.entries(_errors)) {                                
		var elementBox = _form.find("[name='"+ key +"']").removeClass("is-invalid").removeClass("is-valid").addClass("is-invalid");
		
		var isImage = elementBox.attr("data-is-image");

		if ( isImage )
		{
			if (  elementBox.parent().parent().parent().find(".fv-plugins-message-container")  ) {

				elementBox.parent().parent().parent().find(".fv-plugins-message-container").html(value);
			}
			else {

				var createErrorDiv = '<div class="fv-plugins-message-container invalid-feedback">'+ value +'</div>';

				elementBox.parent().parent().parent().append(createErrorDiv);

				elementBox.after(createErrorDiv);
			}
		}
		else 
		{
			if ( elementBox.next().hasClass("fv-plugins-message-container") )
			{
				elementBox.next().html(value);
			}
			else {

				var createErrorDiv = '<div class="fv-plugins-message-container invalid-feedback">'+ value +'</div>';
				elementBox.after(createErrorDiv);
			}
		}
		

		/*
		else if (  elementBox.parent().parent().parent().find(".fv-plugins-message-container")  ) {

			console.log(elementBox.parent().parent().parent().find(".fv-plugins-message-container") );
			elementBox.parent().parent().parent().find(".fv-plugins-message-container").html(value);
		}*/
	}


	failure_callback();
	// show_alert(result.message, "error", "Ok, got it!", "btn-primary");

	// failure_callback(result);
}


function handle_validation_response( element_id, success_callback, failure_callback  )
{
    const submitButton = element_id;
    submitButton.setAttribute('data-kt-indicator', 'on');

    console.log(submitButton, "submitButton");
    // Disable button to avoid multiple click
    submitButton.disabled = true;
    
    submit_form(element_id, function( response ){

        var result = JSON.parse(response);
        $(element_id).closest("form").find(".fv-plugins-message-container").html('');

        if ( result.status )
        {
           
            success_callback(result);
        }
        else {

            var _errors = JSON.parse( result.data );
            for (let [key, value] of Object.entries(_errors)) {                                
                var elementBox = $(submitButton).closest("form").find("[name='"+ key +"']").removeClass("is-invalid").removeClass("is-valid").addClass("is-invalid");
                
				var isImage = elementBox.attr("data-is-image");

				if ( isImage )
				{
					if (  elementBox.parent().parent().parent().find(".fv-plugins-message-container")  ) {

						elementBox.parent().parent().parent().find(".fv-plugins-message-container").html(value);
					}
					else {
	
						var createErrorDiv = '<div class="fv-plugins-message-container invalid-feedback">'+ value +'</div>';

						elementBox.parent().parent().parent().append(createErrorDiv);

						elementBox.after(createErrorDiv);
					}
				}
				else 
				{
					if ( elementBox.next().hasClass("fv-plugins-message-container") )
					{
						elementBox.next().html(value);
					}
					else {
	
						var createErrorDiv = '<div class="fv-plugins-message-container invalid-feedback">'+ value +'</div>';
						elementBox.after(createErrorDiv);
					}
				}
                

				/*
                else if (  elementBox.parent().parent().parent().find(".fv-plugins-message-container")  ) {

                    console.log(elementBox.parent().parent().parent().find(".fv-plugins-message-container") );
                    elementBox.parent().parent().parent().find(".fv-plugins-message-container").html(value);
                }*/
            }

            show_alert(result.message, "error", "Ok, got it!", "btn-primary");

            failure_callback(result);

        }


        submitButton.disabled = false;
        submitButton.removeAttribute('data-kt-indicator');
    })

}

function show_alert( text, icon, confirmation_button_text,  confirmation_button_class, okCallBack = () => {} )
{
    Swal.fire({
        text: text,
        icon: icon,
        buttonsStyling: false,
        confirmButtonText: confirmation_button_text,
        customClass: {
            confirmButton: "btn " + confirmation_button_class
        }
    }).then(function() {
		okCallBack();
	});
}


function show_confirm_delete( successCallBack, cancelCallBack )
{
	Swal.fire({
		text: "Are you sure you want to delete selected record(s)?",
		icon: "warning",
		showCancelButton: true,
		buttonsStyling: false,
		confirmButtonText: "Yes, delete!",
		cancelButtonText: "No, cancel",
		customClass: {
			confirmButton: "btn fw-bold btn-danger",
			cancelButton: "btn fw-bold btn-active-light-primary"
		}
	}).then(function (result) {

		if (result.value) {

			successCallBack();
			
		} else if (result.dismiss === 'cancel') {
			
			cancelCallBack();

		}
	});
}

function submit_form( element_id, callback )
{

    var _form = $(element_id).closest("form"); //$(this).closest("form");    
    console.log(_form);
    var this_site = _form.attr("action");
    var url = this_site;


	var fd = new FormData( _form[0] );

	

    $.ajax({
        /*type: "POST",
        url: url,
        data: _form.serialize(),*/

		type: "POST",
			data:  fd,
			contentType: false,
					cache: false,
			processData:false,
			url: url,


        success: function (response) {

            console.log(response , "response ");
            callback(response);
            // submit_action(response, target, '.targetDIV', _ajax_request_btn);

        }

    });
}

function submit_action( data, target, param1, param2 )
{

	if ( param1 == null || param1 == "undefined" )
	{
		param1	= false;	
	}

	var _result			=  JSON.parse(data) ;
	//console.log(_result);
	
	if ( _result._redirect_to == "" )
	{
		if ( ( _result._call_name  == 'cmstype_with_cmsmenu' )  ||  ( _result._call_name  == 'cmstype_with_typeid' ) )
		{
			
			$( target ).html( _result._TEXT_show_messages );
			render_textarea( $("textarea[name='content'].ckeditor") );
			
			_waiting_screen( "hide" );
			
		}
		else if ( _result._call_name  == 'ajax_get_intents_with_project' )
		{
			$( target ).html( _result._TEXT_show_messages );	
			
			
			if ( param1 == 0 )
			{
				$("select[name='intent']").change();	
			}
			else
			{
				_waiting_screen( "hide" );
			}
		}
		else if ( _result._call_name  == 'cmsmenu_with_position' || _result._call_name  == 'ajax_generate_listing_analytics_graph')
		{
			
			


			$( target ).html( _result._TEXT_show_messages );
			//render_textarea( $("textarea[name='content']") );
			
			_waiting_screen( "hide" );
			
		}
		
		else if ( _result._call_name  == 'ajax_featured_premium_shelters' )
		{


			$( target ).html( _result._TEXT_show_messages );
			//render_textarea( $("textarea[name='content']") );
			
			_waiting_screen( "hide" );
			
			ajax_Listing_Analytics( _result._HEADING_show_messages  );
			
		}
		else if ( _result._call_name  == 'ajax_company_user_login')
		{
			_show_alert( _result._CSS_show_messages, _result._HEADING_show_messages, _result._TEXT_show_messages);
			//render_textarea( $("textarea[name='content']") );
			
			_waiting_screen( "hide" );
			
		}
		
		else if ( _result._call_name == 'ajax_load_locations_by_city' )
		{
			$( target ).html( _result._TEXT_show_messages );
			
			//selectize_inputs( "", "maxsize", $( target ).find("select.selectize_maxsize") );
			selectize_inputs( "", "readonly", $( target ).find("select.selectize") );
			
			
			
			if ( $.type(  window.LaravelDataTables["tbl_listings_list"] ) == "object" )
			{
				window.LaravelDataTables["tbl_listings_list"].draw();
			}
			
			if ( $("select[name='left_widget_location_id']").length > 0 )
			{
				$("select[name='left_widget_location_id']").change(function(){
					
					if ( $.type(  window.LaravelDataTables["tbl_listings_list"] ) == "object" )
					{
						window.LaravelDataTables["tbl_listings_list"].draw();
					}
					
				});
			}
			
			
			
			_waiting_screen( "hide" );
		}
		else
		{
			$( target ).html( _result._TEXT_show_messages );
			//render_textarea( $("textarea[name='content']") );
			
			_waiting_screen( "hide" );	
		}
		
		
		
		
	}

    
}


function render_textarea( elem  )
{
	$("textarea.ckeditor").each(function(){
		ClassicEditor
		.create( $(this)[0], {
			
		toolbar: {
			items: [
				'heading',
				'|',
				'bold',
				'italic',
				'link',
				'bulletedList',
				'numberedList',
				'|',
				'outdent',
				'indent',
				'|',
				// 'imageUpload',
				'blockQuote',
				'insertTable',
				'mediaEmbed',
				'undo',
				'redo'
			]
		},

		language: 'en',
		image: {
			toolbar: [
				'imageTextAlternative',
				'imageStyle:inline',
				'imageStyle:block',
				'imageStyle:side'
			]
		},
		table: {
			contentToolbar: [
				'tableColumn',
				'tableRow',
				'mergeTableCells'
			]
		},
			licenseKey: '',
			
			
			
		} )
		.then( editor => {
			var _text = editor.id;


			EDITORS[editor.sourceElement.id] = editor;
			window.editor = editor;			

			// window.editor.sourceElement.id
			
		} )
		.catch( error => {
			console.error( 'Oops, something went wrong!' );
			console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
			console.warn( 'Build id: fgydboej4r6a-nohdljl880ze' );
			console.error( error );
		} );
	});

	



	// if ( elem == null )
	// {
	// 	elem		= $("textarea.ckeditor1");
	// }
	// else
	// {
	// 	if ( elem.length > 0 )
	// 	{
	// 		var editor 	= CKEDITOR.instances[elem.attr("name")];
			
	// 		if (editor) {  editor.destroy(true); }
	// 	}
	// 	else
	// 	{
	// 		return false;	
	// 	}
	// }
	
	

	// var base_url = SITE_URL;
	// elem.each(function(){
		
		
	// 	CKEDITOR.replace( $(this).attr("name"),
	// 	{
			
	// 		filebrowserBrowseUrl : base_url + "public/assets/admincms/js/ckeditor/filemanager/browser/default/browser.html?Connector=" + base_url + "public/assets/admincms/js/ckeditor/filemanager/connectors/php/connector.php" ,
	// 		filebrowserImageBrowseUrl : base_url + "public/assets/admincms/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=" + base_url + "public/assets/admincms/js/ckeditor/filemanager/connectors/php/connector.php" ,
	// 		filebrowserFlashBrowseUrl : base_url + "public/assets/admincms/js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=" + base_url + "public/assets/admincms/js/ckeditor/filemanager/connectors/php/connector.php" ,
	// 		filebrowserUploadUrl  : base_url + "public/assets/admincms/js/ckeditor/filemanager/connectors/php/upload.php?Type=File",
	// 		filebrowserImageUploadUrl : base_url + "public/assets/admincms/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image",
	// 		filebrowserFlashUploadUrl : base_url + "public/assets/admincms/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash"
	// 	});
		
	// });

}
