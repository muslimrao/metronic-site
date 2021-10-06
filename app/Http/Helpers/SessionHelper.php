<?php

namespace App\Http\Helpers;


use App\Models\SiteSetting;
use Illuminate\Support\Facades\Session;
use App\Http\Library\CustomFunctions;


class SessionHelper
{
    function __construct()
    {
    }

    static function site_settings_session($force_update = FALSE)
    {



  
        //re-declare session parameters (muslim)
        if (!Session::has("SiteSetting") || $force_update) {
            $settings_master                     = CustomFunctions::get_SiteSettings_data();
           
            if ($settings_master != NULL) {
                if ($settings_master->count()) {


                    #define SiteSetting CONSTANT
                    $config                     = $settings_master->get()->first()->toArray();
                    $TMP_alter_emails3             = GeneralHelper::generate_toccbcc_emails($config['email_to'], array("email_to", "email_bcc"));
                    $config                     = GeneralHelper::merge_multi_arrays(array($config, $TMP_alter_emails3));

                    $session_array                 = array_change_key_case($config, CASE_UPPER);

                    Session::put("SiteSetting", $session_array);
                    

                }
            }



            /*
            #ALWAYS IN SESSION
            $TMP_select                            = array("subscriber_projectroles_id", "staffmember_projectroles_id");
            $edit_details                        = SiteSetting::first()->select($TMP_select);

            if ($edit_details->count() > 0) {
                foreach ($TMP_select as $key) {
                    Session::put("SiteSetting." .  strtoupper($key), $edit_details->get()->first()->$key);
                }
            }*/
        }
    }
}
