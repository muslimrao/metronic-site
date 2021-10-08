<?php

namespace App\Http\Controllers;

use App\Http\Helpers\GeneralHelper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Schema;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Load all env Setting and Constants in Application 
     *
     * @return void
     */
    protected function getDefaultConstants()
    {

        $domain_name = @$_SERVER['SERVER_NAME'];

        if ( !Schema::hasTable('airlines')  )
        {
            die("fa");
            GeneralHelper::show_error_page("503");
        }
        
        $airline_details = \App\Models\Airlines::where("domain", $domain_name)->get();
        if ( $airline_details -> count() <= 0  )
        {
            GeneralHelper::show_error_page("503");
        }
        else {
         
            session(['airline_details' => $airline_details->first()->toArray()]);
        }


        foreach (\Config::get('constants') as $constant => $value) {
            $this->constants[$constant] = $value;
        }
    }
}
