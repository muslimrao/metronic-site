<?php

namespace App\Http\Middleware;

use \App\Http\Library\RoleManagement;
use \App\Http\Helpers\GeneralHelper;
use Closure;
use Route;

class VerifyRolePermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $redirect_URL = null)
    {
        
        $List_Operations    = GeneralHelper::role_permissions_operations();

     
        $ROUTE_name         = explode( ".", Route::currentRouteName() );

        

        $OPERATION          = $ROUTE_name[ count($ROUTE_name) - 1];


     
        if ( count($ROUTE_name) > 2 )
        {
            $tmp_last = $ROUTE_name[ count($ROUTE_name) - 1 ];
            unset( $ROUTE_name[ count($ROUTE_name) - 1 ] );

            $tmp_first = implode("/", $ROUTE_name);

            unset($ROUTE_name);
            $ROUTE_name[0]      = $tmp_first;
            $ROUTE_name[1]      = $tmp_last;
        }
  
        

        if ( RoleManagement::is_Domain_Owner() )
        {

        }
        else  if ( Route::currentRouteName() == null )
        {
            die("ROUTE NAME is not defined.");
        }
		/*else if ( in_array( $ROUTE_name[0],  GeneralHelper::role_permissions_left_pages( TRUE )  ) )
		{
			
		}*/
        else if ( in_array($ROUTE_name[1], $List_Operations))
        {
			
			
        
            if ( !RoleManagement::if_Allowed( $ROUTE_name[0], $ROUTE_name[1] ) )
            {

                return \App\Http\Helpers\GeneralHelper::show_error_page("401");
            }
        }

        return $next($request);
    }
}
