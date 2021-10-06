<?php

namespace App\Http\Controllers\sitecontrol\auth;

use Illuminate\Http\Request;
use App\Http\Library\RoleManagement;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MY_controller;

class LogoutController extends MY_controller
{
    /**
     * Logout user function
     *
     * @param Request $request
     * @return void
     */
    public function getLogout( Request $request )
	{
		Auth::guard( RoleManagement::get_current_user_logged_in_GUARD()  ) -> logout(); 
		$request->session()->flush();
		return redirect( route("domainuser.login") );
	}
}
