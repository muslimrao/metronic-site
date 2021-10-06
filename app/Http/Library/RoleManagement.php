<?php

namespace App\Http\Library;

use \Illuminate\Support\Facades\Session;
use App\Http\Helpers\GeneralHelper;
use App\Models\PilotRoles;
use App\Models\Pilots;
use App\Models\RolePermissions;
use \App\RolesPermissions;
use App\ProjectRoles;
use App\ProjectMembers;
use Mage;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

use function Complex\ln;

class RoleManagement
{

    static function get_role_id_with_name( $role_name = FALSE  )
    {

        $tmp_pilot_roles = PilotRoles::query();
        foreach ($tmp_pilot_roles ->get() as $pilot_role)
        {
            if ( $role_name == $pilot_role->slug)
            {
                return $pilot_role->id;
            }
        }

        return FALSE;

    }


 


    static function get_current_user_logged_in_GUARD()
    {

        if (Auth::guard(\Config::get('constants.GUARD_SUPERADMIN'))->check()) {
            
            return \Config::get('constants.GUARD_SUPERADMIN');

        } else if (Auth::guard(\Config::get('constants.GUARD_DOMAIN_USER'))->check()) {

            return \Config::get('constants.GUARD_DOMAIN_USER');
        }
      

        return FALSE;
    }

    /* IS (Guard) */
    static function is_Super_Admin()
    {
        return Auth::guard(\Config::get('constants.GUARD_SUPERADMIN'))->check();
    }

    static function is_Domain_Owner()
    {
        if ( !Auth::guard (RoleManagement::get_current_user_logged_in_GUARD()) -> check() )
        {
            return FALSE;
        }

        if ( Auth::guard( RoleManagement::get_current_user_logged_in_GUARD())->user()->role_slug == "owner")
        {
            return TRUE;
        }

        return FALSE;
    }

    static function is_Domain_Admin()
    {
        if ( !Auth::guard (RoleManagement::get_current_user_logged_in_GUARD()) -> check() )
        {
            return FALSE;
        }

     
        if ( Auth::guard( RoleManagement::get_current_user_logged_in_GUARD())->user()->role_slug == "admin")
        {
            return TRUE;
        }

        return FALSE;
    }

    static function is_Domain_Manager()
    {        
        if ( !Auth::guard (RoleManagement::get_current_user_logged_in_GUARD()) -> check() )
        {
            return FALSE;
        }

        if ( Auth::guard( RoleManagement::get_current_user_logged_in_GUARD())->user()->role_slug == "manager")
        {
            return TRUE;
        }

        return FALSE;
    }

    static function is_Domain_Registered_User()
    {        
        if ( !Auth::guard (RoleManagement::get_current_user_logged_in_GUARD()) -> check() )
        {
            return FALSE;
        }
        
        if ( Auth::guard( RoleManagement::get_current_user_logged_in_GUARD())->user()->role_slug == "registered_user")
        {
            return TRUE;
        }

        return FALSE;
    }

    static function is_Domain_Guest()
    {        
        if ( !Auth::guard (RoleManagement::get_current_user_logged_in_GUARD()) -> check() )
        {
            return TRUE;
        }

     

        return FALSE;
    }



    static function get_pilot_ROLE_IDS_with_logged_in_ROLE_ID()
    {

        $pilot_role_ids = PilotRoles::query();

        
        if ( RoleManagement::is_Domain_Owner())
        {
            
        }
        else if ( RoleManagement::is_Domain_Admin())
        {
            
            $pilot_role_ids->whereNotIn("id", [   

                RoleManagement::get_role_id_with_name("owner")

            ]);
        }
        else if ( RoleManagement::is_Domain_Manager())
        {
            $pilot_role_ids->whereNotIn("id", [
                
                RoleManagement::get_role_id_with_name("owner"),
                RoleManagement::get_role_id_with_name("admin")

            ]);
        }
        else if ( RoleManagement::is_Domain_Registered_User())
        {
            $pilot_role_ids->whereNotIn("id", [
                
                RoleManagement::get_role_id_with_name("owner"),
                RoleManagement::get_role_id_with_name("admin"),
                RoleManagement::get_role_id_with_name("manager"),

            ]);
        }
        else if ( RoleManagement::is_Domain_Guest())
        {
            $pilot_role_ids->whereNotIn("id", [
                
                RoleManagement::get_role_id_with_name("owner"),
                RoleManagement::get_role_id_with_name("admin"),
                RoleManagement::get_role_id_with_name("manager"),

            ]);
        }

        return $pilot_role_ids-> pluck('id')->toArray();
    }

   
    


    /* GET Logged IN ID */
    static function get_current_user_logged_in_ID($guard = "")
    {
        if ($guard == "") {
            $guard                = self::get_current_user_logged_in_GUARD();
        }

        return Auth::guard($guard)->ID();
    }

    /*
    static function getCurrent_LoggedInRole($guard = "")
    {
        if ($guard == "") {
            $guard                = self::get_current_logged_in_guard();
        }

        if ($guard === \Config::get('constants.GUARD_PROJECTSUBSCRIBER')) {

            $project_member         = ProjectMembers::findorfail(Auth::guard($guard)->ID());
            $project_role             = ProjectRoles::findorfail($project_member->projectroles_id);
            return $project_role->name;
        }
        return $guard;
    }
    */

    //list of functions:
    //is_Admin, is_QC, is_ST, is_VM, is_Vendor, is_CS, is_WL
    //if_Allowed (3 parameters ) [0]directory, [1]operation
    public static function __callStatic($name, $arguments)
    {
        
        if (substr($name, 0, 3) == "is_") {
            $get_ROLE_to_check                  = explode("_", $name);
            $if_YES                             = FALSE;
            $requested_role                     = strtolower($get_ROLE_to_check[1]);

            switch (TRUE) {
                case $requested_role == "subscriber":
                    if (Auth::guard(\Config::get('constants.GUARD_PROJECTSUBSCRIBER'))->check()) {
                        if (Auth::guard(\Config::get('constants.GUARD_PROJECTSUBSCRIBER'))->user()->projectroles_id == Session::get("site_settings.SUBSCRIBER_PROJECTROLES_ID")) {
                            $if_YES                        = TRUE;
                        }
                    }
                    break;

                case $requested_role == "staffmember":
                    if (Auth::guard(\Config::get('constants.GUARD_PROJECTSUBSCRIBER'))->check()) {
                        if (Auth::guard(\Config::get('constants.GUARD_PROJECTSUBSCRIBER'))->user()->projectroles_id == Session::get("site_settings.STAFFMEMBER_PROJECTROLES_ID")) {
                            $if_YES                        = TRUE;
                        }
                    }
                    break;

                case $requested_role == "projectmember" and  Auth::guard(\Config::get('constants.GUARD_PROJECTSUBSCRIBER'))->check():
                    $if_YES                        = TRUE;
                    break;

                case $requested_role == "admin" and  Auth::guard(\Config::get('constants.GUARD_SUPERADMIN'))->check():
                    $if_YES                        = TRUE;
                    break;

                default:
                    break;
            }

            return $if_YES;

            /*
			die("ASASASA");
            $ROLE_details                      = \App\Rolesidentifier::get()->first();
            if ( $ROLE_details -> count() > 0 )
            {
                
                
                $get_ROLE_to_check                  = explode("_", $name);
                $if_YES                             = FALSE;
                $requested_role                     = strtolower( $get_ROLE_to_check[1] );
                switch ( TRUE )
                {
                    case $requested_role == "admin" and Session::get("role_id") == $ROLE_details->administrator_role_id:
                        $if_YES                     = TRUE;
                        break;

                    case $requested_role == "qc" and Session::get("role_id") == $ROLE_details->quality_assurance_role_id:
                        $if_YES                     = TRUE;
                        break;
                    
                    case $requested_role == "st" and Session::get("role_id") == $ROLE_details->sourcing_team_role_id:
                        $if_YES                     = TRUE;
                        break;
                    
                    case $requested_role == "vm" and Session::get("role_id") == $ROLE_details->vendor_manager_role_id:
                        $if_YES                     = TRUE;
                        break;
                    
                    case $requested_role == "vendor" and Session::get("role_id") == $ROLE_details->vendor_role_id:
                        $if_YES                     = TRUE;
                        break;
                    
                    case $requested_role == "cs" and Session::get("role_id") == $ROLE_details->customer_support_role_id:
                        $if_YES                     = TRUE;
                        break;
                    
                    case $requested_role == "wl" and Session::get("role_id") == $ROLE_details->warehousing_role_id:
                        
                        $if_YES                     = TRUE;
                        break;

                    default:
                        $if_YES                     = FALSE;
                        break;
                }
				
			}
				
                
                
            }
            else
            {
               GeneralHelper::show_error_page("401");
            }

			*/
        } 
        else if (substr($name, 0, 10) == "if_Allowed") {

            
            if ( RoleManagement::is_Domain_Owner() )
            {
                return TRUE;
            }


            $_tmp_pilot_role_id = RoleManagement::get_role_id_with_name("guest");
            if ( Auth::guard(  RoleManagement::get_current_user_logged_in_GUARD() )->check() )
            {
                $_tmp_pilot_role_id     = Auth::guard(  RoleManagement::get_current_user_logged_in_GUARD() )->user()->pilot_role_id;
            }

           
            //Array ( [0] DIRECTORY [1] => OPERATION )
            $_record     = RolePermissions::where(
                [
                    "pilot_role_id"         => $_tmp_pilot_role_id, #Auth::guard(  RoleManagement::get_current_user_logged_in_GUARD() )->user()->pilot_role_id,
                    "directory"             => $arguments[0],
                    "operation"             => $arguments[1]
                ]
            );

            

            if ($arguments[0] == "managecategory") {
                #print_r($_record->count());
                #die;

                #echo $arguments[1];
                #die;
            }

            if ($_record->count() > 0) {
                return TRUE;
            }



            return FALSE;
        }
        // else if (substr($name, 0, 10) == "if_Allowed") {

           
        //     $DIRECTORY                      = $arguments[0];
        //     //return true;
        //     $DIRECTORY                      = $arguments[0];
        //     $explode_DIRECTORY                = explode("/", $DIRECTORY);
        //     //dd([$name, $arguments,substr($name, 0, 10),$explode_DIRECTORY]);
        //     if (count($explode_DIRECTORY) < 2) {
        //         die("Some Error in Routes (as)");
        //     }
        //     $DIRECTORY                        = $explode_DIRECTORY[1];
        //     $if_slash_found                  = substr($DIRECTORY, strlen($DIRECTORY) - 1, strlen($DIRECTORY));
        //     if ($if_slash_found           == "/") {
        //         $DIRECTORY          = substr($DIRECTORY, 0, strlen($DIRECTORY) - 1);
        //     }

        //     if (!array_key_exists(1, $arguments)) {
        //         $arguments[1]           = "show";
        //     }



        //     if ($arguments[1] == "view_records") {
        //         $arguments[1]            = "view";
        //     }


        //     if (self::is_Admin()) {
        //         /*
		// 		if ( $DIRECTORY == "managerolespermissions" )
		// 		{
		// 			return FALSE;	
		// 		}
		// 		*/
        //         return TRUE;
        //     }









        //     //Array ( [0] DIRECTORY [1] => OPERATION )
        //     $_record     = RolesPermissions::where(
        //         [
        //             "project_id"             => Auth::guard(\Config::get('constants.GUARD_PROJECTSUBSCRIBER'))->user()->project_id,
        //             "projectroles_id"         => Auth::guard(\Config::get('constants.GUARD_PROJECTSUBSCRIBER'))->user()->projectroles_id,
        //             "directory"             => $DIRECTORY,
        //             "operation"             => $arguments[1]
        //         ]

        //     );




        //     if ($arguments[0] == "managecategory") {
        //         #print_r($_record->count());
        //         #die;

        //         #echo $arguments[1];
        //         #die;
        //     }

        //     if ($_record->count() > 0) {
        //         return TRUE;
        //     }



        //     return FALSE;
        // }
         else {
            GeneralHelper::show_error_page("503");
        }
    }
}