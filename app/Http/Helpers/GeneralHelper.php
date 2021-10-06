<?php

namespace App\Http\Helpers;


use URL;
use Cache;
use App\CmsMenu;
use App\Enums\Days;
use App\PostAnswer;
use GuzzleHttp\Client;
use App\Http\Helpers\EnumConstants;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Models\Model_Site_Settings;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\projects\Toby\Api_Services;
use App\Http\Controllers\projects\Toby\helpers\EnumValues;
use App\Models\Pilots;

class GeneralHelper
{
    static function find_text_in_array($find_in_this_text, $_find_this_text)
    {

        foreach ($_find_this_text as $sKey) {

            if (stripos(strtolower($find_in_this_text), strtolower($sKey)) !== false) {
                return $sKey;
            }
        }

        return false;
    }


    static function validate_if_array_is_not_empty($_data)
    {
        $_is_FAIL                    = FALSE;
        foreach ($_data as $fa) {
            if ($fa != "") {
                $_is_FAIL            = TRUE;
            }
        }

        return $_is_FAIL;
    }


    static function convert_smart_quotes($string)

    {
        $search = [                 // www.fileformat.info/info/unicode/<NUM>/ <NUM> = 2018
            "\xC2\xAB",     // « (U+00AB) in UTF-8
            "\xC2\xBB",     // » (U+00BB) in UTF-8
            "\xE2\x80\x98", // ‘ (U+2018) in UTF-8
            "\xE2\x80\x99", // ’ (U+2019) in UTF-8
            "\xE2\x80\x9A", // ‚ (U+201A) in UTF-8
            "\xE2\x80\x9B", // ‛ (U+201B) in UTF-8
            "\xE2\x80\x9C", // “ (U+201C) in UTF-8
            "\xE2\x80\x9D", // ” (U+201D) in UTF-8
            "\xE2\x80\x9E", // „ (U+201E) in UTF-8
            "\xE2\x80\x9F", // ‟ (U+201F) in UTF-8
            "\xE2\x80\xB9", // ‹ (U+2039) in UTF-8
            "\xE2\x80\xBA", // › (U+203A) in UTF-8
            "\xE2\x80\x93", // – (U+2013) in UTF-8
            "\xE2\x80\x94", // — (U+2014) in UTF-8
            "\xE2\x80\xA6"  // … (U+2026) in UTF-8
        ];

        $replace = [
            "<<",
            ">>",
            "'",
            "'",
            "'",
            "'",
            '"',
            '"',
            '"',
            '"',
            "<",
            ">",
            "-",
            "-",
            "..."
        ];

        return str_replace($search, $replace, $string);
    }
    static function convert_string_to_bool($_bool_text)
    {
        if ($_bool_text == "true") {
            return TRUE;
        }

        return FALSE;
    }

    static function transliterateString($txt)
    {
        $transliterationTable = array('á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C', 'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c', 'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C', 'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd', 'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f', 'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G', 'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G', 'ĥ' => 'h', 'Ĥ' => 'H', 'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I', 'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L', 'ľ' => 'l', 'Ľ' => 'L', 'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N', 'ň' => 'n', 'Ň' => 'N', 'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE', 'ṗ' => 'p', 'Ṗ' => 'P', 'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R', 'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S', 'ṡ' => 's', 'Ṡ' => 'S', 'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't', 'Ṫ' => 'T', 'ţ' => 't', 'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u', 'Û' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ư' => 'u', 'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w', 'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y', 'Ý' => 'Y', 'ỳ' => 'y', 'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z', 'Ž' => 'Z', 'ż' => 'z', 'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a', 'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g', 'д' => 'd', 'Д' => 'd', 'е' => 'e', 'Е' => 'E', 'ё' => 'e', 'Ё' => 'E', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z', 'и' => 'i', 'И' => 'i', 'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l', 'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o', 'п' => 'p', 'П' => 'p', 'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u', 'ф' => 'f', 'Ф' => 'f', 'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch', 'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '', 'ы' => 'y', 'Ы' => 'y', 'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja');
        return str_replace(array_keys($transliterationTable), array_values($transliterationTable), $txt);
    }

    static  function ul_li_structure($_data)
    {
        $_li            = "<ul>";
        foreach ($_data as $_key => $_value) {
            $_li        .= "<li>" . $_key . ": " . $_value . "</li>";
        }
        $_li            .= "</ul>";

        return $_li;
    }


    static function add_prefix_image_name($image_name, $list_prefix)
    {
        $image_tmp      = explode('/', $image_name);
        $image_path     = join('/', array_slice($image_tmp, 0, count($image_tmp) - 1));
        $image_path     = $image_path . '/';
        $image_tmp         = end($image_tmp);
        $return_data    = [];
        if (is_array($list_prefix)) {
            foreach ($list_prefix as $key => $value) {
                $return_data[] = $image_path . $value . $image_tmp;
            }
        } else {
            $return_data[] = $image_path . $list_prefix . $image_tmp;
        }

        return $return_data;
    }

    static function compare_dates($d1, $d2)
    {


        $_TMP =  strtotime($d1) - strtotime($d2);

        if ($_TMP > 0) {
            return 1;
        } elseif ($_TMP < 0) {
            return -1;
        } elseif ($_TMP == 0) {
            return 0;
        } else {
            return false;
        }
    } # compareDates

    static function _curl_init($mode = "")
    {
        switch ($mode) {
            case "proxy":
                return "192.168.14.114";
                break;

            case "port":
                return "3128";
                break;

            default:
                return "";
                break;
        }
    }

    static function is_localhost()
    {
        $local_ips         = array('127.0.0.1', '192.168.14.8', 'localhost', 'genetech002', '192.168.14.114', '192.168.11.1', '192.168.14.128', '192.168.14.135', '::1');


        if (in_array($_SERVER['REMOTE_ADDR'], $local_ips)) {
            return TRUE;
        } elseif (in_array($_SERVER['HTTP_HOST'], ["192.168.14.8:81"])) {
            return TRUE;
        }

        return FALSE;
    }

    static function init_curl_request($construct_init_params = [], $request_type = "get", $request_endpoint = "/", $request_params = [], $byfoce_Curl = FALSE)
    {
        $request_type                    = strtoupper($request_type);

        $send_params['GET']             = 'query';
        $send_params['POST']             = 'form_params';


        if (self::is_localhost() || $byfoce_Curl || TRUE) {

            $ch = \curl_init();


            if ($request_type == "GET") {
                curl_setopt($ch, CURLOPT_URL, $request_endpoint . "?" . http_build_query($request_params));
            } else {

                curl_setopt($ch, CURLOPT_URL, $request_endpoint);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($request_params));
            }


            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);


            if (self::is_localhost()) {
                curl_setopt($ch, CURLOPT_PROXY,              self::_curl_init("proxy"));
                curl_setopt($ch, CURLOPT_PROXYPORT,          self::_curl_init("port"));
            }


            #curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
            $data                 = $result;
        } else {

            $guzzle_client         = new Client($construct_init_params);
            $response             = $guzzle_client->request($request_type, $request_endpoint, [$send_params[$request_type], $request_params]);

            $data                 = $response->getBody()->getContents();
        }
        return $data;
    }

    /*
	static function get_airport_code($city, $output_context_airport_code = '', $user_id = '')
    {
		
		#$city			= "New York City";
        $api     = new Api_Services;

        $request = new Request();
        $service = 'air';
        $action  = 'getAutoComplete';
        $params  = [
            'string'=>($city),
            'cities'=>'false',
            'regions'=>'false',
            'pois'=>'false',
            'airports'=>'true'
        ];


        $data    					= $api->get_priceline_data($params,$request,$service,$action);
		$response_return			= ["status"			=> false];

		
		if 	( $_AirportCodes = ( $data["getAirAutoComplete"]["results"]["getSolr"]["results"] ) )
		{
		
			//First if for airport_data (because status_code will be there always)
			if ( isset($_AirportCodes["data"]["airport_data"]) )
			{
				$response_return			= 	[	
													"message"			=> $_AirportCodes["data"]["airport_data"],
													"status"			=> true,
												];	
			}
			else if ( isset($_AirportCodes["status_code"]) )
			{
				$response_return			= 	[	
													"message"			=> "There are no airport(s) in your Destination City",
													"status"			=> false,
												];	
			}
		}
		
		print_r($response_return);
		die;
		
		die("ff---");
		
			
        \Log::info('CONFIG UNKNOWN');
        \Log::info(Config::get('Toby.UNKNOWN_INTENT'));
        \Log::info('GET AIRPORT CODE');
        \Log::info($data);
        $airport = $data['getAirAutoComplete']['results']['getSolr']['results'];
        $_TMP    = [];
		
		print_r($data);
		die;
        if($airport['status_code'] == 500 || isset($data['getAirAutoComplete']['error']))
        {       
            $_TMP[] = 'No airport found for '.$city;
        }
		else
		{
            $airport = $airport['data']['airport_data'];
            
            $_TMP[] = 'Select airport code from following';
            foreach ($airport as $key => $value) {
                $_TMP[] = $value['airport'] .' ( '.$value['iata'].' )    ';
            }

			if($output_context_airport_code != '' && $user_id != '')
			{
				Cache::forget($output_context_airport_code.$user_id);
			}
        }
        // return implode(' |     ',$_TMP);
        return $_TMP;
    }
	*/

    static function set_filter_data($_data, $_filter_key, $_is_preserve)
    {
        $_value                                    = "";
        if (array_key_exists(0, $_data)) {
            $_value                                = $_data[0];
        }


        $_is_text                                = TRUE;
        switch ($_filter_key) {
                /*
			case EnumValues::UP_preferred_airlines:
				$_is_text						= FALSE;
				break;
			*/

            case EnumValues::UP_car_types:
            case EnumValues::UP_preferred_airlines:
            case EnumValues::UP_preffered_hotel:

                $_is_text                        = FALSE;
                break;




            default:
                break;
        }

        $_Final_Value                                = $_value;
        if (!$_is_text) {
            $_if_array_exists                        = explode("|", $_value);
            if (count($_if_array_exists) > 0) {
                $_TMP_array                            = [];
                foreach ($_if_array_exists as $intent_child_detail_ID) {

                    $_get_text            = \App\ManageIntentsChildDetail::where("id", $intent_child_detail_ID);
                    if ($_get_text->count() > 0) {
                        $_TMP_array[]     = $_get_text->get()->first()->name;
                    }
                }

                $_Final_Value                        = implode("|", $_TMP_array);
            }
        }





        $fields['filter'][$_filter_key]         = $_Final_Value;
        $fields['preserve']                      = $_is_preserve;

        return $fields;
    }

    static function get_prefered($user_id, $entity = 'airline')
    {
        // dd(PostAnswer::whereUser_id($user_id)->whereHas('question')->get()->pluck('answer')->flatten());

        $_ = PostAnswer::whereUser_id($user_id)
            ->with('question')
            ->whereHas('question', function ($q) use ($entity) {
                $q->whereIn('entity', [$entity]);
            })
            ->get()
            ->pluck('answer')
            ->flatten();


        return $_;
    }


    static function flight_list__($retData)
    {
        $retData = json_decode($retData);
        $temp = [];
        if (isset($retData->data->getAirFlightDepartures)) {
            if (isset($retData->data->getAirFlightDepartures->results)) {
                if (isset($retData->data->getAirFlightDepartures->results->itinerary_data)) {
                    $_ = $retData->data->getAirFlightDepartures->results->itinerary_data;
                    foreach ($_ as $key => $value) {
                        $__ = $value->slice_data->slice_0->airline->name;
                        array_push($temp, $__);
                    }
                }
            }
        }
        return '<ul><li>' . implode('</li><li>', $temp) . '</li></ul>';
    }

    static function generate_chat_li($retData)
    {
        $retData = json_decode($retData, true);

        if (isset($retData['flight'])) return self::flight_list($retData);
        if (isset($retData['hotel'])) return self::hotel_list($retData);
        if (isset($retData['car'])) return self::car_list($retData);
        if (isset($retData['events'])) return self::event_list($retData);
        if (isset($retData['tob_events'])) return self::tob_events_list($retData);
        if (isset($retData['perks'])) return self::perk_list($retData);
    }

    static function car_list($retData)
    {

        $temp = [];
        if (isset($retData['car']['params'])) {
            foreach ($retData['car']['params'] as $key => $value) {
                array_push($temp, $key . ' ==> ' . $value);
            }
        }



        return '<ul><li>' . implode('</li><li>', $temp) . '</li></ul>';
    }

    static function event_list($retData)
    {
        $temp = [];
        if (isset($retData['events']['params'])) {
            if (is_array($retData['events']['params'])) {
                foreach ($retData['events']['params'] as $key => $value) {
                    array_push($temp, $key . ' ==> ' . $value);
                }
            }
        }

        return '<ul><li>' . implode('</li><li>', $temp) . '</li></ul>';
    }

    static function tob_events_list($retData)
    {
        $temp = [];
        if (isset($retData['tob_events']['params'])) {
            if (is_array($retData['tob_events']['params'])) {
                foreach ($retData['tob_events']['params'] as $key => $value) {
                    array_push($temp, $key . ' ==> ' . $value);
                }
            }
        }

        return '<ul><li>' . implode('</li><li>', $temp) . '</li></ul>';
    }

    static function hotel_list($retData)
    {
        $temp = [];
        if (isset($retData['hotel']['params'])) {
            if (is_array($retData['hotel']['params'])) {
                foreach ($retData['hotel']['params'] as $key => $value) {
                    $_value = '';
                    if (is_array($value)) {
                        $_value = json_encode($value);
                    } else {
                        $_value = $value;
                    }
                    array_push($temp, $key . ' ==> ' . $_value);
                }
            }
        }



        return '<ul><li>' . implode('</li><li>', $temp) . '</li></ul>';
    }

    static function perk_list($retData)
    {
        $temp = [];
        if (isset($retData['perks']['params'])) {
            if (is_array($retData['perks']['params'])) {
                foreach ($retData['perks']['params'] as $key => $value) {
                    array_push($temp, $key . ' ==> ' . $value);
                }
            }
        }



        return '<ul><li>' . implode('</li><li>', $temp) . '</li></ul>';
    }

    static function flight_list($retData)
    {
        $temp = [];
        if (isset($retData['flight']['slider'])) {
            foreach ($retData as $key => $value) {
                if (!isset($value['slice_data'])) break;
                $__ = $value['slice_data']['slice_0']['airline']['name'];
                array_push($temp, $__);
            }
        } elseif (isset($retData['flight']['params'])) {
            if (is_array($retData['flight']['params'])) {
                foreach ($retData['flight']['params'] as $key => $value) {
                    array_push($temp, $key . ' ==> ' . $value);
                }
            }
        }



        return '<ul><li>' . implode('</li><li>', $temp) . '</li></ul>';
    }

    static function isJson($string)
    {
        if (is_numeric($string)) return false;
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    static function array_combine_not_empty($arr, $key = 'name', $value = 'value')
    {

        if (isset($arr[$key]) != isset($arr[$value])) return false;
        if (count($arr[$key]) != count($arr[$value])) return false;

        //$arr = array_combine($arr[$key],$arr[$value]);


        $temp = [];
        foreach ($arr[$key] as $i => $v) {
            array_push($temp, array('name' => $arr[$key][$i], 'value' => $arr[$value][$i]));
        }
        $arr = $temp;





        $arr = array_filter($arr);
        unset($arr['']);
        return ($arr);
    }

    // Backup
    static function ____array_combine_not_empty($arr, $key = 'name', $value = 'value')
    {

        if (isset($arr[$key]) != isset($arr[$value])) return false;
        if (count($arr[$key]) != count($arr[$value])) return false;
        $arr = array_combine($arr[$key], $arr[$value]);
        $arr = array_filter($arr);
        unset($arr['']);
        return ($arr);
    }

    static function groupElement($model, $mapToGroup)
    {


        $data = $model->toArray();

        $ret  = [];
        foreach ($data as $key => $value) {

            $___key                                     = $value[$mapToGroup['key']];
            // print_r($___key);
            $ret[$___key]                              = $value[$mapToGroup['value']];



            foreach ($value[$mapToGroup['value']] as $k => $val) {
                $ret[$___key][$k]['answer']             = array();
                $ret[$___key][$k]['get_intent_child']     = array();
                if (isset($val['get_intent_child'])) {

                    $ret[$___key][$k]['get_intent_child']         = $val['get_intent_child']['intent_child_details'];
                    if ($val['get_intent_child']['intent_option'] == EnumConstants::image) {
                        foreach ($ret[$___key][$k]['get_intent_child'] as $key => $value) {
                            $ret[$___key][$k]['get_intent_child'][$key]['value']     = url($value['value']);
                        }
                    }

                    /*
					if ( $val["entity"] == EnumValues::UP_preferred_airlines )
					{
						foreach ($ret[$___key][$k]['get_intent_child'] as $_key => $_value)
						{
							
						}
						
						print_r( $ret[$___key][$k]['get_intent_child'] );
						die;
					}*/
                }


                if (!empty($val['answer'])) {
                    $ret[$___key][$k]['answer'] = $val['answer'][0]['answer'];
                }

                //$ret[$___key][$k]['intent_child_details']['airlines'] = \App\ManageFlight::all();
                # code...
            }




            // if(isset($ret[$___key][$key]['answer'][0]))
            // {
            // 	$ret[$___key][$key]['answer'] = 
            // 	$ret[$___key][$key]['answer'][0]['answer'];

            // }else{

            // 	$ret[$___key][$key]['answer'] = '';
            // }


        }


        return $ret;

        // return $model->map(function ($item) {
        // 	return [$item->intent_name => $item->get_questions->toArray()];
        // });

        // return $model->mapToGroups(function ($item, $key) use ($mapToGroup) {
        // 	return $item[$mapToGroup['key'] = $item[$mapToGroup['value']]];
        // });
    }

    static function timthumb($src, $w = false, $h = false, $add_base_url = FALSE)
    {

        $Query_String            = "";
        if ($w != false) {
            $Query_String            .= "&w=" . $w;
        }
        if ($h != false) {
            $Query_String            .= "&h=" . $h;
        }


        $TMP_image_url                = $src;

        if ($add_base_url) {
            $TMP_image_url            = url($TMP_image_url);
        }

        return url("timthumb.php?src=" . $TMP_image_url . $Query_String);
    }

    static function ListingOption_Style($v, $remove_style = false, $style_number = 1)
    {
        $on_show            = "";
        $featured            = "";
        $premium            = "";
        if ($style_number == 1) {
            $on_show            = "on-show";
            $featured            = "featured";
            $premium            = "premium";
        } else if ($style_number == 2) {
            $on_show            = "onshow";
            $featured            = "featured";
            $premium            = "premium";
        }

        switch (true) {
            case $v->is_on_show    == true:
                $TMP_case        = "<span class='" . $on_show . "'>On Show</span>"; //badge bg-green 
                break;

            case $v->is_featured == true:
                $TMP_case        = "<span class='" . $featured . "'>Featured</span>"; //badge bg-red 
                break;

            case $v->is_premium    == true:
                $TMP_case        = "<span class='" . $premium . "'>Premium</span>"; //badge bg-orange 
                break;

            default:
                $TMP_case        = "";
                break;
        };

        if ($remove_style) {
            $TMP_case            = strip_tags($TMP_case);
        }

        return $TMP_case;
    }


    static function sanitizeInputs($request, $keys, $find, $replace)
    {
        $TMP_keys                            = $keys; #array_keys($request->all());
        foreach ($TMP_keys as $k) {
            $TMP_value                        = $request->only($k)[$k];

            if ($TMP_value == $find) {
                $request->request->add([$k =>  $replace]);
            }
        }
    }

    static function is_numeric($value = false, $greater_than_zero = false)
    {
        if ($value != "" and is_numeric($value) and !$greater_than_zero) {
            return TRUE;
        } else if ($value != "" and is_numeric($value) and $greater_than_zero) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    static function check_isset($_array, $_value, $_type = "text", $_default = '')
    {
        $return_data     = '';
        $_is_exist         = false;
        $__value        = '';

        if (is_array($_array)) {
            if (isset($_array[$_value])) {
                $__value        = $_array[$_value];
                $_is_exist         = true;
            }
        } elseif (is_object($_array)) {
            if (isset($_array->{$_value})) {
                $__value        = $_array->{$_value};
                $_is_exist         = true;
            }
        }

        if ($_is_exist) {
            $return_data = GeneralHelper::set_default_value_for_fields($__value, $_type, false, $_default);
        } else {
            if ($_type == "int") {
                $return_data = 0;
            }
        }

        return $return_data;
    }
    #$_type:	"text", "int"
    static function set_default_value_for_fields($_value, $_type = "text", $make_null = FALSE, $_default_text = "")
    {
        if ($_type == "int") {
            if (isset($_value)) {
                if (GeneralHelper::is_numeric($_value)) {
                    return $_value;
                }
            }

            if (GeneralHelper::is_numeric($_value)) {
                return $_value;
            } else if ($make_null == TRUE) {
                return NULL;
            } else if ($_default_text != "") {
                return $_default_text;
            } else {
                return 0;
            }
        } else if ($_type == "text") {
            if (isset($_value)) {
                if ($_value != "") {
                    return $_value;
                }
            } else if ($make_null == TRUE) {
                return NULL;
            } else if ($_default_text != "") {
                return $_default_text;
            } else {
                return "";
            }
        }
    }

    static function format_duration($text)
    {
        $_TMP = explode(':', $text);
        return /*$_TMP[0].'days '.*/ $_TMP[1] . 'h ' . $_TMP[2] . 'm';
    }

    static function generateNotice($style = "alert", $class = "", $message = false, $title = false)
    {
        $TMP_notice                = "";
        if ($style == "alert") {
            $TMP_notice            = '<div class="alert alert-' . $class . ' alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';

            if ($title) {
                if ($class == "success") {
                    $class        = "check";
                } else if ($class == "danger") {
                    $class        = "close";
                }

                $TMP_notice        .= '<h4><i class="icon fa fa-' . $class . '"></i> ' . $title  . '</h4>';
            }

            $TMP_notice            .= $message;

            $TMP_notice            .= '</div>';
        } else if ($style == "callout") {
            $TMP_notice            .= '<div class="callout callout-' . $class . '">';

            if ($title) {
                $TMP_notice            .= '<h4>' . $title . '</h4>';
            }
            $TMP_notice            .= $message;
            $TMP_notice            .= '</div>';
        }


        return $TMP_notice;
    }

    static function verify_time_format($value)
    {
        $pattern1 = '/^(0?\d|1\d|2[0-3]):[0-5]\d:[0-5]\d$/';
        $pattern2 = '/^(0?\d|1[0-2]):[0-5]\d\s(am|pm)$/i';
        return preg_match($pattern1, $value) || preg_match($pattern2, $value);
    }

    static function get_column_result_array($TMP_array, $TMP_column = FALSE, $key_Name = false)
    {
        $TMP_id                                                        = array();
        if (count($TMP_array) > 0) {
            for ($i = 0; $i < count($TMP_array); $i++) {
                if ($key_Name) {
                    $TMP_id[$TMP_array[$i][$key_Name]]                                            = $TMP_array[$i][$TMP_column];
                } else {
                    $TMP_id[]                                            = $TMP_array[$i][$TMP_column];
                }
            }
        }

        return $TMP_id;
    }

    static function make_slug($model, $slug_value, $slug_field_name, $id, $return_only_first_slug = false, $is_bool = false)
    {
        $tmp_slug                    = str_slug($slug_value);
        $verify_if_slug_exists        = $model::where($slug_field_name, $tmp_slug);

        if ($id) {
            $verify_if_slug_exists->where("id", "!=", $id);
        }

        if ($is_bool) {
            return $verify_if_slug_exists->count();
        } else if ($return_only_first_slug) {
            return $tmp_slug;
        } else {
            if ($verify_if_slug_exists->count() > 0) {
                return self::make_slug($model, $slug_value . str_random(5), $slug_field_name, $id);
            } else {
                return $tmp_slug;
            }
        }
    }

    static function format_date($date,  $format = false, $without_strtotime = false)
    {

        if ($without_strtotime) {
            $_dropoffTime                   = new \DateTime($date);
            $_dropoffTime                   = $_dropoffTime->format($format);

            #return date( $format,  $date );
            return $_dropoffTime;
        } else {
            if ((bool)strtotime($date)) {
                return date($format, strtotime($date));
            } else {
                return NULL;
            }
        }
    }

    static function format_snakecase($str)
    {

        return ucfirst(preg_replace(array('/(?<=[^A-Z])([A-Z])/', '/(?<=[^0-9])([0-9])/'), ' $0', $str));
    }

    static function format_price($price, $symbol = '$',  $is_JS = false)
    {

        if (is_numeric($price)) {

            return $symbol . "" . number_format($price, 0);
        } else {
            return false;
        }
    }

    static function format_bool($input = "", $match_value = FALSE, $debug = FALSE)
    {
        if ($match_value != '') {


            $return_value            = FALSE;

            if ($input ==  $match_value) {
                $return_value    = TRUE;
            }

            return $return_value;
        } else {
            $return_value            = FALSE;
            if ($input) {
                if ($input == "1") {
                    $return_value    = TRUE;
                }
            }

            return $return_value;
            #return ( $input ) ? 1 : 0;
        }
    }

    static function set_value($field = "", $default_value = "")
    {

        return Request::input($field, $default_value);
    }

    static function set_value_core($field = "", $default_value = "")
    {

        return isset($_POST[$field]) ? $_POST[$field] : $default_value;
    }

    static function form_error($errors, $field = "", $isEmptyDiv = false)
    {

        if ( $isEmptyDiv)
        {
            return '<div class="fv-plugins-message-container invalid-feedback"></div>';

        }
        else if ($errors->has($field)) {
            #return '<small><span style="' . $style . '" class="text-red help-block form-error"><strong>' . $errors->first($field) . '</strong></span></small>';

            return '<div class="fv-plugins-message-container invalid-feedback"><div>'. $errors->first($field) .'</div></div>';
        }
    }

    static function format_title($text, $delimiter = '_', $replace_delimiter = ' ')
    {

        return str_replace($delimiter, $replace_delimiter, ucwords($text, $delimiter));
    }

    static function set_class($errors, $field = "")
    {

        if ($errors->has($field)) {
            return 'form-error';
        }
    }

    static function show_alert($description, $title = '', $callback_script = '')
    {
        return '
		<script>
			if(typeof swal == "undefined")
			{
				alert("' . $description . '");
			}else{
				swal("' . $title . '","' . $description . '").then((value) => {' . $callback_script . '});
			}
		</script>';
    }

    static function show_error_page($page, $custom_text = false)
    {
        abort($page);
        //return Response::view('errors.' .  $page, array("text" => $custom_text),  $page);
    }

    static function required_field($fontsize = FALSE, $color = FALSE)
    {
        $className             = '';
        if ($fontsize) {
            $className        .= $fontsize;
        }
        if ($color) {
            $className        .= $color;
        }

        /* $className            = ''; */

        return "<span class='required_field " . $className . "'>*</span>";
    }

    static function generate_toccbcc_emails($emails, $TMP_arr = array())
    {
        $TMP_emails                        = explode("|",  $emails);
        $TMP                            = array();
        $_count                         = count($TMP_emails);
        for ($i = 0; $i < $_count; $i++) {
            $TMP[$TMP_arr[$i]]        = explode(",", $TMP_emails[$i]);
        }

        return $TMP;
    }

    static function get_formatted_data($text, $formatted)
    {
        $return      = [];
        $date_format = 'F d, Y';
        if (empty($formatted)) return $text;
        foreach ($formatted as $t) {
            switch ($t['tag']) {
                case 'date':
                    $_pickupTime        = new \DateTime(($t['text']));
                    $_pickupTime        = $_pickupTime->format($date_format);
                    $return[] = str_replace($t['pre_formatted'], $_pickupTime, $text);
                    break;
                default:
            }
        }
        return implode(' ', $return);
    }

    static function get_data_tag($input, $return = false, $start_tag = ['<<', '>>'], $end_tag = ['<<-', '->>'])
    {
        $regex = '~' . $start_tag[0] . '(.*?)' . $start_tag[1] . '(.*?)' . $end_tag[0] . '(.*?)' . $end_tag[1] . '~';
        preg_match_all($regex, $input, $output);
        $count_matches = count($output);
        $num_matches   = count($output[0]);
        $_tmp          = [];
        $_tmp_map      = ['pre_formatted', 'tag', 'text', 'end_tag'];
        for ($i = 0; $i < $count_matches; $i++) {
            for ($j = 0; $j < $num_matches; $j++) {
                $_tmp[$j][$_tmp_map[$i]] = $output[$i][$j];
            }
        }
        if ($return) {
            return self::get_formatted_data($input, $_tmp);
        }
        return $_tmp;
    }

    static function merge_multi_arrays($array = array(), $array_name = "")
    {
        $tmp                = array();

        for ($x = 0; $x < count($array); $x++) {
            $settings_master                    = $array[$x];



            foreach ($settings_master as $k => $v) {
                if ($array_name == "") {
                    $tmp[$k]                            = $v;
                } else {
                    $tmp[$array_name][$k]                = $v;
                }
            }
        }

        return $tmp;
    }

    static function make_secure_image_link($image_value = "", $w = false, $h = false)
    {
        $show_only_filename         = explode("/", $image_value);


        $lonely_filename            = $show_only_filename[count($show_only_filename) - 1];

        unset($show_only_filename[count($show_only_filename) - 1]);

        $IMPLODE_path               = Crypt::encrypt(implode("/", $show_only_filename) . '/');



        #print_r($show_only_filename    );die;

        $show_url                   = Config::get('constants.JCASSETS_STATIC') . $IMPLODE_path . '/' . $lonely_filename;


        $TMP_return_array            = array(
            "image_url"            => url($show_url),
            "image_path"        => $show_url,
            "lonely_filename"    => $lonely_filename
        );

        return  (object) $TMP_return_array;
    }



    static public function upload_image($request, &$validator, $config_controls, $thumb_controls, $other_controls, $BOOL = FALSE)
	{



		$destinationPath                                = $config_controls['upload_path'];


		//in return 1 means Image uploaded: 2 means hdn_field upload: 3 means Error
		$_POST[$other_controls["input_field"]]          = $other_controls["input_field"];


		if (!array_key_exists('id', $other_controls)) {
			$other_controls['id']				= strtotime("now");
		}

		if (!array_key_exists('thumb', $other_controls)) {
			$other_controls['thumb']			= FALSE;
		}

		if (!array_key_exists('validate', $other_controls)) {
			$other_controls['validate']			= FALSE;
		}

		if (!array_key_exists('db_field', $other_controls)) {
			$other_controls['db_field']			= "";
		}

		if (!array_key_exists('hdn_field', $other_controls)) {
			$other_controls['hdn_field']		= "";
		}

		if (!array_key_exists('input_nick', $other_controls)) {
			$other_controls['input_nick']		= "";
		}

		if (!array_key_exists('only_validate', $other_controls)) {
			$other_controls['only_validate']		= FALSE;
		}




		$upload_image_array						= array();
		$saveData['id']							= $other_controls['id'];
		$db_field								= $other_controls['db_field'];
		$input_field							= $other_controls['input_field'];


		$FILE_uploaded                                  = $request->has($other_controls["input_field"]);

        
		if ($other_controls['is_multiple'] and isset($_FILES[$other_controls["input_field"]])) {

			// getting all of the post data
			$files = $request->file($other_controls["input_field"]);

			// Making counting of uploaded images
			$file_count 				= count($files);


			// start count how many uploaded
			$errorCount 				= 0;

			$collect_HIDDEN_ARRAY		= array();
			if (is_array($request[$other_controls['hdn_field']])) {

				$i = 0;
				foreach ($request[$other_controls['hdn_field']]   as $key => $value) {

					if ($value != "") {
						$explode_value								= explode("/", $value);
						$collect_HIDDEN_ARRAY[$i]["file_name"]		= $explode_value[count($explode_value) - 1];
						$collect_HIDDEN_ARRAY[$i]["index_position"]		= $key;
					}

					$i++;
				}
			}





			$file       = array($other_controls["hdn_field"] => Request::file($other_controls["input_field"]));
			$rules      = array($other_controls["hdn_field"] => 'trim' . $other_controls['validate'] /*. '|mimes:' . $config_controls['allowed_mimes']*/); //mimes:jpeg,bmp,png and for max size max:10000

			// doing the validation, passing post data, rules and the messages
			$image_validation = Validator::make($file, $rules);


			$input_labelName = array(
				$other_controls["hdn_field"]            => $other_controls['input_nick']
			);


			$image_validation->setAttributeNames($input_labelName);


			if ($image_validation->fails() and  !isset($request[$other_controls['hdn_field']])) {

				$upload_image_array             = array(
					"error"             => 3,
					"reason"            => "upload_error",
					"msg"               => $image_validation->messages()
				);


				$validator->after(function ($validator) use ($other_controls, $image_validation) {
					$validator->errors()->add($other_controls["hdn_field"], $image_validation->errors()->first($other_controls["hdn_field"]));
				});
			} else {


				if ($other_controls['only_validate']) {

					$upload_image_array     = array(
						"error"             => 1,
						"reason"            => "pass",
						"hdn_array"         => "Only Validate"
					);
				} else if (Request::file($other_controls["input_field"]) == NULL) {
					$FILE_uploaded                          = FALSE;
				} else {
					if ($errorCount == 0 and "validate_REQUIRED") {
						foreach ($files as $file) {
							$rules 						= array($other_controls["hdn_field"] => 'trim' . $other_controls['validate']); //'required|mimes:png,gif,jpeg,txt,pdf,doc'

							$image_validation 			= Validator::make(array($other_controls["hdn_field"] => $file), $rules);

							$input_labelName 			= array(
								$other_controls["hdn_field"]            => $other_controls['input_nick']
							);


							$image_validation->setAttributeNames($input_labelName);

							if ($image_validation->fails() and count($collect_HIDDEN_ARRAY) <= 0) {
								$errorCount++;
								$upload_image_array             = array(
									"error"             => 3,
									"reason"            => "upload_error",
									"msg"               => $image_validation->messages()
								);

								$validator->after(function ($validator) use ($other_controls, $image_validation) {
									$validator->errors()->add($other_controls["hdn_field"], $image_validation->errors()->first($other_controls["hdn_field"]));
								}); 

								break;
							}



							/*
							if($image_validation->passes())
							{
								
								$destinationPath 		= 'uploads';
								$filename = $file->getClientOriginalName();
								$upload_success = $file->move($destinationPath, $filename);
								$uploadcount ++;
								
							}
							*/
						}
					}


					if ($errorCount == 0 and "validate_MIME") {
						foreach ($files as $file) {
							$rules 						= array($other_controls["hdn_field"] => 'trim' . '|mimes:' . $config_controls['allowed_mimes']); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
							$image_validation 			= Validator::make(array($other_controls["hdn_field"] => $file), $rules);

							$input_labelName 			= array(
								$other_controls["hdn_field"]            => $other_controls['input_nick']
							);


							$image_validation->setAttributeNames($input_labelName);

							if ($image_validation->fails()) {
								$errorCount++;
								$upload_image_array             = array(
									"error"             => 3,
									"reason"            => "upload_error",
									"msg"               => $image_validation->messages($other_controls["hdn_field"])
								); 

                                $validator->after(function ($validator) use ($other_controls, $image_validation) {
									$validator->errors()->add($other_controls["hdn_field"], $image_validation->errors()->first($other_controls["hdn_field"]));
								});
                                 
								break;
							}



							/*
							if($image_validation->passes())
							{
								
								$destinationPath 		= 'uploads';
								$filename = $file->getClientOriginalName();
								$upload_success = $file->move($destinationPath, $filename);
								$uploadcount ++;
								
							}
							*/
						}
					}


					if ($errorCount  == 0) {
						if ($other_controls['only_validate']) {
							$upload_image_array     = array(
								"error"             => 1,
								"reason"            => "pass",
								"hdn_array"         => "Only Validate"
							);
						}
						// checking file is valid.
						else if ($errorCount == 0) {
							$uploadcount = 0;
							$imgData	= array();



							foreach ($files as $_index_position => $file) {

								if ($file) {
									$extension              = $file->getClientOriginalExtension(); // getting image extension
                                    $fileName               = rand(0, PHP_INT_MAX) . '.' . $extension; // renameing image

									$TMP_input              = $file->move($destinationPath, $fileName); // uploading file to given path

									$imgData[]                = array(
                                                                        "file_name"             => $destinationPath.$TMP_input->getBasename(),
                                                                        "index_position"		=> $_index_position
                                                                    );

									$uploadcount++;
								}
							}



							$imgData				= array_merge($imgData, $collect_HIDDEN_ARRAY);




							$upload_image_array     = array(
								"error"             => 1,
								"reason"            => "pass",
								"hdn_array"         => $imgData
							);
						} else {
							$upload_image_array     = array(
								"error"             => 3,
								"reason"            => "upload_error",
								"msg"               => $other_controls["input_nick"] . " is not Valid"
							);


							$validator->after(function ($validator) use ($other_controls, $image_validation, $upload_image_array) {
								$validator->errors()->add($other_controls["hdn_field"], $upload_image_array["msg"]);
							});
						}
					}
				}
			}
		} else if (!$other_controls['is_multiple'] and isset($_FILES[$other_controls["input_field"]])) {


            $__tmp = ['trim','mimetypes:' . $config_controls['allowed_mimes']];// . $other_controls['validate'] .;
            if(!empty($other_controls['validate'])){
                $__tmp[] = $other_controls['validate'];
            }

			$file       = array($other_controls["hdn_field"] => Request::file($other_controls["input_field"]));
			$rules      = array($other_controls["hdn_field"] => implode("|",$__tmp));  

			// doing the validation, passing post data, rules and the messages
			$image_validation = Validator::make($file, $rules);

			$input_labelName = array(
				$other_controls["hdn_field"]            => $other_controls['input_nick']
			);


			$image_validation->setAttributeNames($input_labelName);
            if (Request::has($other_controls["input_field"]) && $image_validation->fails()) {
				$upload_image_array             = array(
					"error"             => 3,
					"reason"            => "upload_error",
					"msg"               => $image_validation->messages($other_controls["hdn_field"])
				);

				$validator->after(function ($validator) use ($other_controls, $image_validation) {
					$validator->errors()->add($other_controls["hdn_field"], $image_validation->errors()->first($other_controls["hdn_field"]));
				});

			} else {

				if ($other_controls['only_validate']) {
					$upload_image_array     = array(
						"error"             => 1,
						"reason"            => "pass",
						"hdn_array"         => "Only Validate"
					);
				} else if (Request::file($other_controls["input_field"]) == NULL) {
					$FILE_uploaded                          = FALSE;
				}

				// checking file is valid.
				else if (Request::file($other_controls["input_field"])->isValid()) {
					$extension              = Request::file($other_controls["input_field"])->getClientOriginalExtension(); // getting image extension
					$fileName               = rand(0, PHP_INT_MAX) . '.' . $extension; // renameing image


					$TMP_input              = Request::file($other_controls["input_field"])->move($destinationPath, $fileName); // uploading file to given path

					$imgData                = array($other_controls["db_field"] => $destinationPath . $TMP_input->getBasename());

					$upload_image_array     = array(
						"error"             => 1,
						"reason"            => "pass",
						"hdn_array"         => $imgData
					);
				} else {
					$upload_image_array     = array(
						"error"             => 3,
						"reason"            => "upload_error",
						"msg"               => $other_controls["input_nick"] . " is not Valid"
					);


					$validator->after(function ($validator) use ($other_controls, $image_validation, $upload_image_array) {
						$validator->errors()->add($other_controls["hdn_field"], $upload_image_array["msg"]);
					});
				}
			}




			/*
            if ($_FILES[$other_controls["input_field"]]["name"] != "" )
            {}
            else
            {
                $FILE_uploaded                          = FALSE;
            }
			*/
		}



		if (!$FILE_uploaded) {


			if ($request[$other_controls['hdn_field']] != '') {
				$imgData	= array($db_field => $request[$other_controls['hdn_field']], 'id'	=> @$saveData['id']);


				$upload_image_array			= array(
					"error"		    =>	2,
					"reason"	    => "hidden",
					"hdn_array"	    =>	$imgData
				);
			} else if ($other_controls['validate']) {

				$upload_image_array			= array(
					"error"	        =>	3,
					"reason"	    => "upload_error",
					"msg"	        =>	"The " . $other_controls["input_nick"] . " field is required"
				);



				$validator->after(function ($validator) use ($other_controls, $image_validation, $upload_image_array) {
					$validator->errors()->add($other_controls["hdn_field"], $upload_image_array["msg"]);
				});
			} else {
				$upload_image_array			= array(
					"error"	        =>	0,
					"reason"	    => "none",
					"msg"	        =>	''
				);
			}
		}



		$upload_image_array["upload_path"]				= $config_controls['upload_path'];
		$upload_image_array["hdn_field"]				= $other_controls['hdn_field'];
		$upload_image_array["db_field"]					= $other_controls['db_field'];
		$upload_image_array["tmp_table_field"]			= $other_controls['tmp_table_field'];
		//$upload_image_array["validator"]                = $validator;
 
		return $upload_image_array;
	}


   
    static function image_link( $post_image, $input_name = "", $runtime_popup = FALSE, $is_multiple = FALSE, $external_URL = FALSE, $append_URL = FALSE, $OTHER_array = array()  )
	{
		
		
		$is_HTTP					= TRUE;#$external_URL;
		$remove_image				= "";
		$image_link					= "";
		$COLORBOX_class				= "";
		
		if ( $is_multiple )
		{
			$images_array			=  self::set_value($input_name, $post_image);


			$___input				= "";
			$___text				= "";

			$is_TRUE				= false;
			
			if ( is_array( $images_array) )
			{
				$___text						= " <ul class='ilinks_sortable'>";
				foreach ($images_array as $key => $value)
				{
					$only_name					= explode("/", $value);
					$only_name					= $only_name[ count($only_name) -1 ];
					
					$is_TRUE					= TRUE;
					$random						= "_" . str_random(16);

					$image_link					= '<a href="'. url( $value ) .'" class="modalImage">'. $only_name .'</a>';
					$remove_image				= '&nbsp;&nbsp;<a class="label label-danger"  href="javascript:;" onclick="remImage(\''. $input_name . $random .'\');">(removeimage)</a> ';


					$___text					.= '<li> <small class="'. $input_name . $random .'"> ' . $image_link . $remove_image . ' </small>';
					$___text					.= '<input type="hidden" value="'. $value .'" id="'. $input_name . $random . '" name="'. $input_name .'[]" /> </li> ';
				}
				$___text						.= '</ul>';

			}
			
			if ( !$is_TRUE  and false)
			{
				$random						= "_" . str_random(16);
				$___text					.= '<input type="hidden" value="" id="'. $input_name . $random . '" name="'. $input_name .'[]" /> </li> ';	
			}


			return $___text . $___input;
		}
		else
		{
			if ( self::set_value($input_name, $post_image) != "" )
			{
				
				
				if ( $is_HTTP )
				{
					if ( $append_URL )
					{
						$show_url           = (object) array(   "image_path"    => $append_URL . self::set_value($input_name, $post_image),
							"lonely_filename"   => $append_URL . self::set_value($input_name, $post_image) );
					}
					else
					{
						$show_url           = (object) array(   "image_path"    => self::set_value($input_name, $post_image),
							"lonely_filename"   => self::set_value($input_name, $post_image) );
					}
					
				}
				else
				{
					
					$show_url					= self::make_secure_image_link( self::set_value($input_name, $post_image), FALSE );
				}		
				
				$is_IFRAME					= FALSE;
				if ( array_key_exists("iframe", $OTHER_array) )
				{
					
					if ( $OTHER_array["iframe"] != "" )
					{
						$is_IFRAME					= TRUE;
						$image_link					= '<a onclick="_runtimePopup(\''. $OTHER_array["iframe"] .'\', \''. url( $show_url->image_path ) .'\')" href="javascript:;" >'. $show_url->lonely_filename .'</a>';
					}
				}
				
				
				if ( !$is_IFRAME )
				{
					$image_link					= '<a class="modalImage" href="'. url( $show_url->image_path ) .'" class="'.$COLORBOX_class.'">'. $show_url->lonely_filename .'</a>';
				}

				$remove_image				= '&nbsp;&nbsp;<a class="label label-danger"  href="javascript:;" onclick="remImage(\''. $input_name .'\');">(Remove Image)</a> ';
			}


			if ( !$runtime_popup )
			{
				$remove_image				= "";
			}

			return '<small>' . $image_link . $remove_image . ' </small>';
		}
	}

    static function generate_intent_child_image($input_name, $post_image, $prefix = '')
    {
        $url = URL::to('/') . '/' . Config::get('constants.INTENT_CHILD_IMAGE') . $prefix;


        if ($input_name == '') {
            return $post_image;
            #return $url.$post_image;
        }
        return self::image_link($input_name, $post_image, false, false, false, $url = '');
    }

    public static function role_permissions_operations()
    {
        return array(/*"show",*/ "view", /*"view_records",*/ "add", "edit", "save", "delete");
    }

    public static function role_permissions_left_pages($ignore_pages = false)
    {
        if ($ignore_pages) {
            
            return array( 

                array(
                    "text"          => "Site Landing Page",
                    "directory"        => "/",
                ),
                
                array(
                    "text"          => "Dashboard",
                    "directory"        => "dashboard",
                ),
    
                array(
                    "text"          => "About Us",
                    "directory"        => "about-us",
                    // "dont_include"    => array("add", "edit", "save", "delete", "show")
                ),

            );
        }


        return array(
            

            array(
                "text"          => "Dashboard",
                "directory"        => "dashboard",
                "dont_include"    => array("add", "save", "edit", "delete")

            ),


            array(
                "text"          => "About Us",
                "directory"        => "about-us",
                "dont_include"    => array("add", "save", "edit", "delete")
            ),

            array(
                "text"          => "Pilot View",
                "directory"        => "pilot/view",
                "dont_include"    => array("add", "save", "edit", "delete")
            ),


            array(
                "text"          => "Pilot List",
                "directory"        => "managepilots"
            ),


            array(
                "text"          => "Flight History",
                "directory"        => "manageflightshistory"
            ),


            array(
                "text"          => "Account Settings",
                "directory"        => "managemyaccount",
                "dont_include"    => array("add")

            ),


            array(
                "text"          => "Air Crafts",
                "directory"        => "managesitesettings/aircraft",
            ),

            array(
                "text"          => "Ranks",
                "directory"        => "managesitesettings/ranks",
            ),


            array(
                "text"          => "Site Settings",
                "directory"        => "managesitesettings",
                "dont_include"    => array("add", "edit" )

            ),



            

          
        );
    }


    static function array_sort_by_column(&$arr, $col, $dir = SORT_ASC)
    {
        $sort_col = array();
        foreach ($arr as $key => $row) {
            $sort_col[$key] = $row[$col];
        }

        array_multisort($sort_col, $dir, $arr);
    }

    static function get_parents($pid, &$found = array(), $Model_Array = false)
    {

        if (!$Model_Array) {
            $_Model_Name                                        = CmsMenu::where("id", ">", 0);
            $_Parent_ID                                            = "parentid";
            $_ID                                                = "id";
        } else {
            $_Model_Name                                        = $Model_Array["model_name"];
            $_Parent_ID                                            = $Model_Array["parent_field"];
            $_ID                                                = $Model_Array["id_field"];
        }



        $result            = $_Model_Name->where($_ID, $pid);


        if ($result->count() > 0) {
            foreach ($result->get() as $row) {
                $found[] =  $row->$_ID;

                self::get_parents($row->$_Parent_ID, $found, $Model_Array);
            }
        }
        return $found;
    }

    static public function getParentCategoryIds($category, $remove_these_ids = array(), $include_position = false, $Model_Array = false)
    {

        if (!$Model_Array) {
            $_Model_Name                                        = CmsMenu::where("id", ">", 0);
            $_Parent_ID                                            = "parentid";
            $_ID                                                = "id";
        } else {
            $_Model_Name                                        = $Model_Array["model_name"];
            $_Parent_ID                                            = $Model_Array["parent_field"];
            $_ID                                                = $Model_Array["id_field"];
        }

        $tmp_found_array                                        = array();
        $TMP_parent_ids                                         = self::get_parents($category["parentid"], $tmp_found_array, $Model_Array);


        foreach ($remove_these_ids as $key => $value) {
            if (in_array($value, $TMP_parent_ids)) {
                $TMP_index                                          = array_search($value, $TMP_parent_ids);
                unset($TMP_parent_ids[$TMP_index]);
            }
        }

        if ($include_position) {
            $Tmp_menu                            = $_Model_Name->where($_ID, $category["parentid"]);
            if ($Tmp_menu->count() > 0) {
                $TMP_parent_ids[]                = "P__" . $Tmp_menu->get()->first()->MenuPositions()->get()->first()->id;
            }
        }


        $TMP_parent_ids                     = array_reverse($TMP_parent_ids);

        return implode(",", $TMP_parent_ids);
    }

    static function output_addons($TMP_addons)
    {
        $output                        = '';
        foreach ($TMP_addons as $k => $v) {
            $output                    .= '<div class="input-group">
			<input class=" form-control"  readonly="readonly" value="' . $v['plugin'] . '"  /> 
			<small>' . $v['description'] . '</small>
			</div><br />';
        }

        return $output;
    }

    static function lock_chat($user_id)
    {
        $output = '<span id="msgLock-' . $user_id . '" data-toggle="tooltip" data-placement="right" title="" class="badge bg-blue"><i class="fa fa-lock"></i></span>';

        return $output;
    }

    static function _return_cms_textarea($request, $is_content = TRUE)
    {

        if ($is_content) {
            $listingdata                = array(
                "name"            => "content",
                "id"            => "content",
                "cols"            => 50,
                "rows"            => 10,
                "class"            => "ckeditor1",
                "value"            => self::set_value("content", $request["content"])
            );







            $TMP_addons[]                = array(
                "plugin"        => '[EXAMPLES PLUGINS]',
                "description"    => 'The above code will replace with some text (  <code> defined in code </code> )'
            );

            $output                     = self::output_addons($TMP_addons);
            $output                    .= \Form::textarea('content', self::set_value("content", $request["content"]), ["class" => "form-control ckeditor1"]);
        } else {
            $output                    = \Form::textarea('content', self::set_value("content", $request["content"]), ["class" => "form-control"]);
        }


        return $output;
    }

    static function show_image($src = '', $alt = '', $title = '', $class = '')
    {
        return '<img alt="' . $alt . '" src="' . $src . '" title="' . $title . '"  class="' . $class . '" >';
    }

    static function get_intent_child($id, $child_id)
    {

        $intent_child = \App\ManageIntentChild::whereIntent_id($id)->get();
        $rendor       = '';

        foreach ($intent_child as $key => $value) {
            $checked = ($value->id == $child_id);
            $rendor  .= $value->rendercheckbox($checked);
        }
        return $rendor;
        /*$intent_child = \App\ManageIntentChild::find($id);

		if(! $intent_child) return false;

		return $intent_child->rendercheckbox(true);*/
    }

    static function render_checkbox($name = '', $value = '', $title = '', $isChecked = false, $fn = false)
    {

        $temp         = $name . '-' . $value;
        $isChecked     = $isChecked ? 'checked' : '';
        $fn          = !$fn          ?     ''       : 'changeSingleRadioState(this)';


        $html  = '<div class="wrap-checkbox">';
        $html .= '<input type="radio" class="intent-radio simple" name="' . $name . '" id="' . $temp . '" value="' . $value . '" onclick="' . $fn . '" ' . $isChecked . '>';
        $html .= '<label for="' . $temp . '" class="intent-label">' . ucfirst($title) . '</label>';
        $html .= '</div>';

        return $html;
        /*
		return \Form::checkbox($name, self::set_value($name, $value), 
			["class"=>$class,'id'=>$name]) . \Form::label($name, $title); 
			*/
    }

    static function get_key_value_list_from_array($array, $html = '')
    {
        if (!empty($array)) {
            foreach ($array as $key => $p) {

                $html .= '<b>' . title_case($key) . '</b>';
                $html .= ": ";
                if (is_array($p)) {
                    $html .= '<br/>';
                    $html .= '&nbsp;&nbsp;&nbsp;';
                    /**
                     * ! We dont have to concatinate because it is a static method and variable retains their values inside them
                     */
                    $html = self::get_key_value_list_from_array($p, $html);
                } else {
                    $html .= $p;
                    $html .= '<br/>';
                }
            }
        }
        return $html;
    }

    static function form_array_generator(&$data, $return_array = false,  $db_data = [], array $empty_inputs = [], array $filled_inputs = [])
    {
        $empty_inputs                   = $empty_inputs;
        $filled_inputs                  = $filled_inputs;


        if ($return_array == true) {


            for ($x = 0; $x < count($empty_inputs); $x++) {
                $data[$empty_inputs[$x]]                    = array();
            }


            for ($x = 0; $x < count($empty_inputs); $x++) {

                for ($m = 0; $m < count($db_data); $m++) {
                    $data[$empty_inputs[$x]][]            = $db_data[$m][$filled_inputs[$x]];
                }
            }

            return $data;
        } else {

            for ($x = 0; $x < count($empty_inputs); $x++) {

                if ($empty_inputs[$x] == "anyID") {
                    foreach ($data['DB_ID_Changes'] as $value) {
                        $data[$empty_inputs[$x]][$value['id']]          = FALSE;
                    }
                } else {
                    $data[$empty_inputs[$x]]                            = array();
                }
            }


            return $data;
        }
    }

    static function form_fields_generator(&$data, $return_array = false,  $db_data = [], array $empty_inputs = [], array $filled_inputs = [])
    {
        if ($return_array == true) {


            for ($x = 0; $x < count($empty_inputs); $x++) {


                $explode_empty_inputs            = explode("|", $empty_inputs[$x]);
                $empty_inputs[$x]                = $explode_empty_inputs[0];

        
                $tmp_value                        = $db_data[$filled_inputs[$x]];

                if (count($explode_empty_inputs) > 1) {
                    switch ($explode_empty_inputs[1]) {


                        case "default_date":
                            if ($db_data[$filled_inputs[$x]]  == NULL) {
                                $tmp_value            = "00-00-0000";
                            } else {
                                $tmp_value            = date("d-m-Y", strtotime($db_data[$filled_inputs[$x]]));
                            }
                            break;

                        case "default_time":
                                if ($db_data[$filled_inputs[$x]]  == NULL) {
                                    $tmp_value            = "00-00";
                                } else {
                                    $tmp_value            = date("H:i A", strtotime($db_data[$filled_inputs[$x]]));
                                }
                                break;
                        
                        // case "default_minutes_seconds":
                        //     if ($db_data[$filled_inputs[$x]]  == NULL) {
                        //         $tmp_value            = "00.00";
                        //     } else {
                        //         $tmp_value            = date("H:i A", strtotime($db_data[$filled_inputs[$x]]));
                        //     }
                        //     break;
                                

                        case "images_types":
                            $tmp_value                  = $data[ $explode_empty_inputs[0] ];
                         
                            break;

                            
                            break;


                        case "default":
                            break;
                    }
                }



                $data[$empty_inputs[$x]]        = $tmp_value;
            }
        } else {

            for ($x = 0; $x < count($empty_inputs); $x++) {

                $explode_empty_inputs                = explode("|", $empty_inputs[$x]);
                $empty_inputs[$x]                    = $explode_empty_inputs[0];
                $tmp_value                            = "";


                if (count($explode_empty_inputs) > 1) {
                    switch ($explode_empty_inputs[1]) {

                        case "default_number_1":
                            $tmp_value                = 3;
                            break;

                        case "default_date":
                            $tmp_value                = "00-00-0000";
                            break;

                        case "default_time":
                            $tmp_value                = "00:00:00";
                            break;

                        case "default_minutes_seconds":
                            $tmp_value                = "00.00";
                            break;
                            
                            

                        case "images_types":
                            $tmp_value                  = $data[ $explode_empty_inputs[0] ];
                            break;

                        
                        case "default_zero":
                            $tmp_value                  = 0;
    

                        case "default":
                            break;
                    }
                }

                $data[$empty_inputs[$x]]        = $tmp_value;
            }
        }
    }

    /**
     * String Append Whatever you want function
     *
     * @param [type] ...$array
     * @return void
     */
    static function stringAppend($separator = " ", ...$array)
    {
        return trim(implode($separator, $array));
    }

    static function getFullName($user_id)
    {
        return Pilots::where('id', $user_id)->first()->full_name;
    }

    
	/**
     * Upload base64 image in db function
     *
     * @param [type] $request
     * @param string $request_key
     * @param boolean $upload_backup_txt
     * @param string $folder_name
     * @return void
     */
	static function upload_base64_image(&$request, $request_key = 'signature', $upload_backup_txt = true, $folder_name = "signatures")
	{ 
        $base64_image 					=  $request[$request_key];
	    $folderPath 					= 'uploads/'.$folder_name.'/';
	   
	    $image_parts 					= explode(";base64,", $base64_image);
	    $image_type_aux 				= explode("image/", $image_parts[0]);
	      
	    $image_type 					= $image_type_aux[1];
	      
	    $image_base64	 				= base64_decode($image_parts[1]);
	    $rand_file_name 				= hash('sha1', time());
	    $signature 						= $folderPath . $rand_file_name . '.'.$image_type;
        $txt_filename 					= "";

        if($upload_backup_txt)
        { 
            $txt_filename                       = $folderPath . hash('sha1', time()).'.txt';
            $is_save 							= Storage::disk('public')->put($txt_filename,$base64_image );
        }

        $request->request->add([
                                                        'signature' 		=> $signature,
                                                        'txt_filename' 	=> $txt_filename,
                                                    ]);

        file_put_contents(public_path($signature), $image_base64);
	}
    /**
     * base image 64 function
     *
     * @param [type] $txt_filename
     * @return void
     */
	static function get_base64_image($txt_filename)
	{  
        $is_file_exist                  = Storage::disk('public')->exists($txt_filename);
        if(!$is_file_exist){
            return null;
        }
       return Storage::disk('public')->get($txt_filename);
	}

    /**
     * Get enum value function
     *
     * @param [type] $class_name
     * @param [type] $key
     * @return void
     */
    static public function get_enum_value($class_name,$key ){
        return $class_name::fromKey(strtoupper($key))->value;
    }

    /**
     * Get Top Level Message function
     *
     * @param [type] $messages
     * @return void
     */
    static public function get_top_level_message($messages){
        $__topLevelMessages__ = "";
        if(is_array($messages)){ 
        }else{
            $__topLevelMessages__ = $messages;
        }
        return $__topLevelMessages__;
    }

    /**
     * Get Opening Days Txt function
     *
     * @param [type] $messages
     * @return void
     */
    static public function get_opening_days_txt(array $days){ 
         
        return substr(Days::fromValue((int) $days[0]["opening_day"])->key,0,3)  .' - '.substr(Days::fromValue((int) $days[count($days) - 1]["opening_day"])->key,0,3);

    }
    static public function is_company_open($company){
        $is_open = '<p class="close-card">CLOSE</p>';
        if(in_array(date('w'),array_column($company['companies_opening_days'],'opening_day'))){
            if((time() > strtotime($company['company_opening_hours']) )  && (time() < strtotime($company['company_closing_hours'])) ){
               return $is_open = '<p class="open-card">OPEN</p>';
            }
        }
        return  $is_open;
    }
    static function RemoveEmptyNull($data){
        $__data = $data;
        if(!is_array($data)){
            $__data = (array) $__data;
        }
        foreach($__data as $key => $val ){
            if(empty($val)){
                unset($__data[$key]);
            }
        }
        return $__data;
    }

    static function curl_get( string $url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $return = curl_exec($curl);
        curl_close($curl);
        return $return;
    }
}