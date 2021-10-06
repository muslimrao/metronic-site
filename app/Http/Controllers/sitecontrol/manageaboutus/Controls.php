<?php

namespace App\Http\Controllers\sitecontrol\manageaboutus;


use Illuminate\Support\Facades\Config;
use App\Http\Controllers\MY_controller;
use App\Http\Library\RoleManagement;
use App\Models\Pilots;
use Illuminate\Support\Facades\Auth;

class Controls extends MY_controller
{
    public function __construct()
    {
        parent::__construct();
     
        
        $this->data = $this->default_data();
 

        $this->data["_heading"]                                 = "About Us";

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



        $this->data["_pagetitle"]       = $this->data["_heading"] . " - ";
        $this->data["_directory"]       = $this->data['admin_path'] . "manageaboutus/";
        $this->data['_pageview']        = $this->data["_directory"] . "view";


       
        
        
    }
    public function view()
    {
        $this->data['out_great_team'] = Pilots::where("airline_id", get_airline_ID() );
     
        return view($this->constants["SITECONTROL_TEMPLATE"], $this->data);
    }
}
