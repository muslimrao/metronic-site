<?php
namespace App\Providers;

use App\Http\Helpers\GeneralHelper;
use Form;
use HTML;
use Route;
use \App\Http\Library\RoleManagement;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;


class FormMacrosServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::macro('unique_formid', function () {
            return Form::hidden('unique_formid', GeneralHelper::set_value("unique_formid", Str::random(40)) );
        });
		
		Form::macro('options', function ( $optionsValue ) 
		{
            return Form::hidden('option', $optionsValue );
        });
        
        Form::macro('add', function ( $url, $_controller, $_heading = FALSE ) {
            
         
            if ( RoleManagement::if_Allowed( $_controller, 'add' ) )
            {


                return '<a href="'.  $url .'">
                        <button type="button" class="btn btn-primary " >


                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                        transform="rotate(-90 11.364 20.364)" fill="black" />
                                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                </svg>
                            </span>
                            Add '. $_heading .'

                        </button>
                    </a>';

                // return  '<a href="'. $url. '">'
                //         . '<input data-operation="add" type="button" class="btn btn-warning btn-flat submit_btn_form" value="' . trans('general_lang.txt_add') . '"  />'
                //         . '</a>';
            }
            return '';
            
        });
        
        Form::macro('edit', function ( $url, $_controller) {
            
            if ( RoleManagement::if_Allowed( $_controller, 'edit' ) )
            {
                return '<div class="menu-item px-3">
                        <a href="'. $url .'"
                            class="menu-link px-3 submit_btn_form">
                            Edit
                        </a>
                    </div>';
            }
            
            return '';
            
        });


        Form::macro('delete_selected', function ($_controller, $_data_operation = 'delete_selected') {
            
            if ( RoleManagement::if_Allowed( $_controller, 'delete' ) )
            {
                return '<button type="button" class="btn btn-danger submit_btn_form" data-operation="'. $_data_operation .'">Delete Selected</button> ';
            }
            
            return '';
            
        });

        Form::macro('delete_single', function ($_controller, $_data_operation = 'delete') {
            
            if ( RoleManagement::if_Allowed( $_controller, 'delete' ) )
            {
                return '<div class="menu-item px-3"> <a href="javascript:;" class="menu-link px-3 submit_btn_form" data-operation="'. $_data_operation .'" >Delete</a> </div>';
            }
            
            return '';
            
        });



        

        
        Form::macro('save', function ($_controller, $second_attr = array()) {
            

            if ( RoleManagement::if_Allowed( $_controller, 'save' ) )
            {
				$first_attr			= array('class' => 'btn btn-success font-weight-bolder text-uppercase px-9 py-4 form-submit-btn ');
				$attr				= array_merge($first_attr, $second_attr);
				
                return  Form::submit('Save', $attr);
            }
            
            return '';
            
        });

        Form::macro('save_ajax', function ($_controller, $second_attr = array()) {
            
            if ( RoleManagement::if_Allowed( $_controller, 'save' ) )
            {
				return '<button type="button" class="btn btn-primary btn_Ajax_Request" id="">Save Changes</button>';
            }
            
            return '';
            
        });
        
		Form::macro('save_e', function ($_directory, $second_attr = array()) {
            
            //if ( RoleManagement::if_Allowed( $_directory, 'save' ) )
            //{
				$first_attr			= array('class' => 'btn btn-warning btn-flat', 'name' => 'save_and_edit');
				$attr				= array_merge($first_attr, $second_attr);
				
                return  Form::submit('Save &amp; Edit', $attr);
            //}
            
            //return '';
            
        });
		
		Form::macro('save_a', function ($_directory, $second_attr = array()) {
            
            //if ( RoleManagement::if_Allowed( $_directory, 'save' ) )
            //{
				$first_attr			= array('class' => 'btn btn-warning btn-flat', 'name' => 'save_and_add_new');
				$attr				= array_merge($first_attr, $second_attr);
				
                return  Form::submit('Save &amp; Add New', $attr);
            //}
            
            //return '';
            
        });
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}