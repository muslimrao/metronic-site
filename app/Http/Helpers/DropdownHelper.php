<?php

namespace App\Http\Helpers;

use App\Enums\Days;
use App\Enums\Role;
use App\Enums\Status;
use App\Enums\RegisterBy;
use Illuminate\Support\Facades\DB;
use App\Enums\ClpCdlApplicantHolder;
use App\Http\Library\RoleManagement;
use Illuminate\Support\Facades\Auth;

class DropdownHelper
{

    static function runtime_dropdown( $data_array, $key_value = array(), $first_index = FALSE )
	{

		$tmp_array											= array();

        #if ( $first_index != "" )
		if ( is_array($first_index) )
		{
			$tmp_array[ $first_index["key"] ]				= $first_index["value"];
		}

		if ( count($key_value) > 0 )
		{
			if($data_array) {
				foreach ( $data_array as $row )
				{
					$tmp_array[ $row[ $key_value["key"] ] ] 		= $row[ $key_value["value"] ];
				}
			}
		}
		else
		{
			if($data_array)
			{
				foreach ( $data_array as $row )
				{
					$tmp_array[ $row ] 		= $row;
				}
			}
		}

		return $tmp_array;
	}

    
    static function weekdays_dropdown($placeholder_text = "Select Day", $find_key = FALSE, $is_array_flip = FALSE)
    {
        $week_day               = array();

        if ($placeholder_text !== FALSE) {
            $week_day[""] = $placeholder_text;
        }

        $week_day[0]            = 'Sunday';
        $week_day[1]            = 'Monday';
        $week_day[2]            = 'Tuesday';
        $week_day[3]            = 'Wednesday';
        $week_day[4]            = 'Thursday';
        $week_day[5]            = 'Friday';
        $week_day[6]            = 'Saturday';


        if ($find_key !== FALSE) {
            if (array_key_exists($find_key, $week_day)) {
                return $week_day[$find_key];
            } else {
                return $week_day[0];
            }
        }

        return $week_day;
    }


    static function pilot_roles_dropdown($hideFirstIndex = FALSE, $where_query = FALSE, $where_not_in_query = FALSE,  $find_key = FALSE, $placeholder_text = 'Select Role')
    {
        $tmp_array = [];

        if  ( $hideFirstIndex == false )
        {
            if ($placeholder_text !== false) {
                $tmp_array[""] = $placeholder_text;
            }
        }


        $pilot_roles = \App\Models\PilotRoles::query();



        if ( $where_query !== false )
        {
            $pilot_roles->where($where_query);
        }

        if ( $where_not_in_query !== false )
        {
            foreach ($where_not_in_query as $not_in_query)
            {
                $pilot_roles->whereNotIn($not_in_query[0], $not_in_query[1]);
            }
           
            
        }

        foreach ($pilot_roles->get() as $city) {

            $tmp_array[$city->id] = $city->name;
        }



        if ($find_key !== FALSE) {
            if (array_key_exists($find_key, $tmp_array)) {
                return $tmp_array[$find_key];
            } else {
                return $tmp_array[0];
            }
        }

        return $tmp_array;
    }


    static function pilot_dropdown($hideFirstIndex = FALSE,  $find_key = FALSE, $placeholder_text = 'Select Pilot')
    {
        $tmp_array = [];

        if ($placeholder_text !== false) {
            $tmp_array[""] = $placeholder_text;
        }


        $pilots = \App\Models\Pilots::query();
        $pilots->where("airline_id", get_airline_ID());
        $pilots->whereIn("pilot_role_id", RoleManagement::get_pilot_ROLE_IDS_with_logged_in_ROLE_ID());




        
        foreach ($pilots->get() as $pilot) {

            $tmp_array[$pilot->id] = $pilot->full_name;
        }



        if ($find_key !== FALSE) {
            if (array_key_exists($find_key, $tmp_array)) {
                return $tmp_array[$find_key];
            } else {
                return $tmp_array[0];
            }
        }

        return $tmp_array;
    }


    
    static function hub_dropdown($hideFirstIndex = FALSE,  $find_key = FALSE, $placeholder_text = 'Select Hub')
    {
        $tmp_array = [];

        if ($placeholder_text !== false) {
            $tmp_array[""] = $placeholder_text;
        }


        $hubs = \App\Models\Hubs::query();
        $hubs->where("airline_id", get_airline_ID() );

        foreach ($hubs->get() as $hub) {

            $tmp_array[$hub->id] = $hub->hub_name;
        }



        if ($find_key !== FALSE) {
            if (array_key_exists($find_key, $tmp_array)) {
                return $tmp_array[$find_key];
            } else {
                return $tmp_array[0];
            }
        }

        return $tmp_array;
    }


    static function aircraft_dropdown($hideFirstIndex = FALSE,  $find_key = FALSE, $placeholder_text = 'Select Aircraft')
    {
        $tmp_array = [];

        if ($placeholder_text !== false) {
            $tmp_array[""] = $placeholder_text;
        }


        $aircrafts = \App\Models\Aircraft::query();
        $aircrafts->where("airline_id", get_airline_ID() );



        
        foreach ($aircrafts->get() as $pilot) {

            $tmp_array[$pilot->id] = $pilot->aircraft_name;
        }



        if ($find_key !== FALSE) {
            if (array_key_exists($find_key, $tmp_array)) {
                return $tmp_array[$find_key];
            } else {
                return $tmp_array[0];
            }
        }

        return $tmp_array;
    }

    static function timezones_dropdown($hideFirstIndex = FALSE,  $find_key = FALSE, $placeholder_text = 'Select Timezone')
    {
        $tmp_array = [
            "Etc/GMT+12" => "(GMT-12:00) International Date Line West",
            "Pacific/Midway" => "(GMT-11:00) Midway Island, Samoa",
            "Pacific/Honolulu" => "(GMT-10:00) Hawaii",
            "US/Alaska" => "(GMT-09:00) Alaska",
            "America/Los_Angeles" => "(GMT-08:00) Pacific Time (US & Canada)",
            "US/Arizona" => "(GMT-07:00) Arizona",
            "America/Managua" => "(GMT-06:00) Central America",
            "US/Central" => "(GMT-06:00) Central Time (US & Canada)",
            "America/Bogota" => "(GMT-05:00) Bogota, Lima, Quito, Rio Branco",
            "US/Eastern" => "(GMT-05:00) Eastern Time (US & Canada)",
            "Canada/Atlantic" => "(GMT-04:00) Atlantic Time (Canada)",
            "America/Argentina/Buenos_Aires" => "(GMT-03:00) Buenos Aires, Georgetown",
            "America/Noronha" => "(GMT-02:00) Mid-Atlantic",
            "Atlantic/Azores" => "(GMT-01:00) Azores",
            "Etc/Greenwich" => "(GMT+00:00) Greenwich Mean Time  => Dublin, Edinburgh, Lisbon, London",
            "Europe/Amsterdam" => "(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna",
            "Europe/Helsinki" => "(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius",
            "Europe/Moscow" => "(GMT+03:00) Moscow, St. Petersburg, Volgograd",
            "Asia/Tehran" => "(GMT+03:30) Tehran",
            "Asia/Yerevan" => "(GMT+04:00) Yerevan",
            "Asia/Kabul" => "(GMT+04:30) Kabul",
            "Asia/Yekaterinburg" => "(GMT+05:00) Yekaterinburg",
            "Asia/Karachi" => "(GMT+05:00) Islamabad, Karachi, Tashkent",
            "Asia/Calcutta" => "(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi",
            "Asia/Katmandu" => "(GMT+05:45) Kathmandu",
            "Asia/Dhaka" => "(GMT+06:00) Astana, Dhaka",
            "Asia/Rangoon" => "(GMT+06:30) Yangon (Rangoon)",
            "Asia/Bangkok" => "(GMT+07:00) Bangkok, Hanoi, Jakarta",
            "Asia/Hong_Kong" => "(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi",
            "Asia/Seoul" => "(GMT+09:00) Seoul",
            "Australia/Adelaide" => "(GMT+09:30) Adelaide",
            "Australia/Canberra" => "(GMT+10:00) Canberra, Melbourne, Sydney",
            "Asia/Magadan" => "(GMT+11:00) Magadan, Solomon Is., New Caledonia",
            "Pacific/Auckland" => "(GMT+12:00) Auckland, Wellington",
            "Pacific/Tongatapu" => "(GMT+13:00) Nuku'alofa"
        ];

        if ($placeholder_text !== false) {
            $tmp_array[""] = $placeholder_text;
        }



        if ($find_key !== FALSE) {
            if (array_key_exists($find_key, $tmp_array)) {
                return $tmp_array[$find_key];
            } else {
                return $tmp_array[0];
            }
        }

        ksort($tmp_array);

        return $tmp_array;
    }

    static function currency_dropdown($hideFirstIndex = FALSE,  $find_key = FALSE, $placeholder_text = 'Select Currency')
    {
        $array = array(
            "USD" => "$" , //U.S. Dollar
            "AUD" => "$" , //Australian Dollar
            "BRL" => "R$" , //Brazilian Real
            "CAD" => "C$" , //Canadian Dollar
            "CZK" => "Kč" , //Czech Koruna
            "DKK" => "kr" , //Danish Krone
            "EUR" => "€" , //Euro
            "HKD" => "&#36" , //Hong Kong Dollar
            "HUF" => "Ft" , //Hungarian Forint
            "ILS" => "₪" , //Israeli New Sheqel
            "INR" => "₹", //Indian Rupee
            "JPY" => "¥" , //Japanese Yen 
            "MYR" => "RM" , //Malaysian Ringgit 
            "MXN" => "&#36" , //Mexican Peso
            "NOK" => "kr" , //Norwegian Krone
            "NZD" => "&#36" , //New Zealand Dollar
            "PHP" => "₱" , //Philippine Peso
            "PLN" => "zł" ,//Polish Zloty
            "GBP" => "£" , //Pound Sterling
            "SEK" => "kr" , //Swedish Krona
            "CHF" => "Fr" , //Swiss Franc
            "TWD" => "$" , //Taiwan New Dollar 
            "THB" => "฿" , //Thai Baht
            "TRY" => "₺" //Turkish Lira
            );

            $tmp_array = array();
        foreach ($array as $key => $value)
        {
            $tmp_array[  $key ] = $key;
        }

       
       #     $tmp_array = array_flip($tmp_array);
        if ($placeholder_text !== false) {
            $tmp_array[""] = $placeholder_text;
        }



        if ($find_key !== FALSE) {
            if (array_key_exists($find_key, $tmp_array)) {
                return $tmp_array[$find_key];
            } else {
                return $tmp_array[0];
            }
        }

        ksort($tmp_array);

        return $tmp_array;
    }



    static function rank_dropdown($hideFirstIndex = FALSE, $find_key = FALSE, $placeholder_text = 'Select Rank')
    {
        $tmp_array = [];

        if ($placeholder_text !== false) {
            $tmp_array[""] = $placeholder_text;
        }


        $ranks = \App\Models\Ranks::query();
        $ranks->where("airline_id", get_airline_ID() );

        
        foreach ($ranks->get() as $rank) {

            $tmp_array[$rank->id] = $rank->rank_name;
        }



        if ($find_key !== FALSE) {
            if (array_key_exists($find_key, $tmp_array)) {
                return $tmp_array[$find_key];
            } else {
                return $tmp_array[0];
            }
        }

        return $tmp_array;
    }


    static function YesNo_dropdown( $find_key = '' )
	{
		$droparray          = array("1"          	=> "Yes",
			"0"          	=> "No");


		if ( is_numeric ( $find_key) )
		{
			if ( array_key_exists($find_key, $droparray) )
			{
				return $droparray[ $find_key ];	
			}
			else
			{
				return $droparray[0];	
			}
		}

		return $droparray;

	}	
	

    static function gender_dropdown()
    {
        $tmp_array = [
                        'M' => 'Male',
                        'F' => 'Female'
                    ];
        return $tmp_array;
    }

    


    static function emailmode_dropdown()
    {
        $droparray            = array(
            "smtp"            => "SMTP",
            "mail"            => "MAIL"
        );

        return $droparray;
    }
}