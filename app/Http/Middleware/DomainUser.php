<?php

namespace App\Http\Middleware;

use App\Http\Helpers\GeneralHelper;
use App\Http\Library\RoleManagement;
use App\Models\RolePermissions;
use Closure;
use Route;
use Illuminate\Support\Facades\Auth;

class DomainUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( Auth::guard( \Config::get('constants.GUARD_DOMAIN_USER')  )->check() == false ) 
        {

            $is_allowed         = FALSE;
            $ROUTE_name         = explode( ".", Route::currentRouteName() );
            if ( count($ROUTE_name) > 1 )
            {
                if ( count($ROUTE_name) > 2 )
                {
                    $tmp_last = $ROUTE_name[ count($ROUTE_name) - 1 ];
                    unset( $ROUTE_name[ count($ROUTE_name) - 1 ] );
        
                    $tmp_first = implode("/", $ROUTE_name);
        
                    unset($ROUTE_name);
                    $ROUTE_name[0]      = $tmp_first;
                    $ROUTE_name[1]      = $tmp_last;
                }
    
                
                $_tmp_pilot_role_id = RoleManagement::get_role_id_with_name("guest");
                if ( Auth::guard(  RoleManagement::get_current_user_logged_in_GUARD() )->check() )
                {
                    $_tmp_pilot_role_id     = Auth::guard(  RoleManagement::get_current_user_logged_in_GUARD() )->user()->pilot_role_id;
                }


                //Array ( [0] DIRECTORY [1] => OPERATION )
                $_record     = RolePermissions::where(
                    [
                        "pilot_role_id"         => $_tmp_pilot_role_id,
                        "directory"             => $ROUTE_name[0],
                        "operation"             => $ROUTE_name[1]
                    ]
                );

                $List_Operations    = GeneralHelper::role_permissions_operations();
                if ( in_array($ROUTE_name[1], $List_Operations))
                {            
                    if ( RoleManagement::if_Allowed( $ROUTE_name[0], $ROUTE_name[1] ) )
                    {
                        $is_allowed         = TRUE;
                    }
                }
            }
            
            if ( !$is_allowed )
            {
                return redirect( route("domainuser.login") );
            }
        }

        return $next($request);
    }
}
