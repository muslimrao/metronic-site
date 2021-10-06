<?php

namespace App\Http\Library;

use Log;
use Config;
use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Enums\Status;
use App\Models\Admin;
use App\Enums\LoginFor;
use App\Models\TruckDriver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Request;
use App\Models\DriverAssociatedWithCompany;
use BenSampo\Enum\Exceptions\InvalidEnumMemberException;

class CustomValidator extends Validator
{
    function validateduplicate($attribute, $value, $format)
	{
        // var_dump($format);die;
        if ( $format[0] == null)
        {
            return false;
        }
		return $format[0];
		
	}

    /**
     * user email exist or not function
     *
     * @param [type] $attribute
     * @param [type] $value
     * @param [type] $parameters
     * @return void
     */

     	
	function validateprojectwithrolealreadyexists($attribute, $value, $parameters)
	{
		return $parameters[0];
		
	}
    
 
    public function validateuseremailexist($field_name, $field_value, $parameters)
    {
 
     
        if ( $parameters[0] == \Config::get('constants.GUARD_DOMAIN_USER')  )
        {
            if (\App\Models\Pilots::where([$field_name => $field_value, "airline_id" => $parameters[1]])->count() > 0) {
                return true;
            }    
        }

        return false;
    }



    public function validatecurrentloggedinpassword($attribute, $value, $parameters)
    {
     
        $credentials = [
            "email" =>  Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )->user()->email,
            "password" => ($value),
        ];
 
        if (Auth::guard( RoleManagement::get_current_user_logged_in_GUARD() )->validate($credentials)) {
            return true;
        }

        
        return false;
    }
    
    public function validatelogincredentials($attribute, $value, $parameters)
    {
        #$parameters[2] //GUARD
        #$parameters[3] //DOMAIN ID

        $request = Request::all();
        $credentials = [
            $parameters[0] => $request[$parameters[0]],
            $parameters[1] => $request[$parameters[1]],
        ];

        if ( $parameters[2] == \Config::get('constants.GUARD_DOMAIN_USER'))
        {
            if (Auth::guard($parameters[2])->validate($credentials)) {
                return true;
            }
    
        }
        
        return false;
    }


    /**
     * Username Verification function
     *
     * @param [type] $attribute
     * @param [type] $value
     * @param [type] $parameters
     * @return void
     */
    public function validateuseremailverification($attribute, $value, $parameters)
    {
        $user = \App\User::where($attribute, $value);

        if ($user->count() > 0) {
            if ($user->get()->first()->EmailVerifiedAt != null) {
                return true;
            }
        }

        return false;
    }

    /**
     * Valid email function
     *
     * @param [type] $attribute
     * @param [type] $value
     * @param [type] $params
     * @return void
     */
    public function validatevalidemail($attribute, $value, $params)
    {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $value)) ? false : true;
    }

    /**
     * Recaptch validation function
     *
     * @param [type] $attribute
     * @param [type] $value
     * @param [type] $params
     * @return void
     */
    public function validatevalidaterecaptcha($attribute, $value, $params)
    {

        $request = Request::all();

        $url = "https://www.google.com/recaptcha/api/siteverify";

        $data = [
            'secret' => Config::get('constants.SECRET_KEY'),
            'response' => $value,
        ];
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
            ],
        ];
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $responseKeys = json_decode($response, true);

        $responseKeys['FormID'] = $request['_token'];
        $responseKeys['IPAddress'] = Request::getClientIp(true);
        $responseKeys['SessionID'] = Session::getId();

        Log::channel('formlog')->info($responseKeys);

        if ($responseKeys['success']) {
            if ($responseKeys['score'] < Config::get('constants.THRESHOLD')) {
                return false;
            } else {

                return true;
            }
        }
        return false;
    }

    /**
     * valid login for function
     *
     * @param [type] $attribute
     * @param [type] $value
     * @param [type] $params
     * @return void
     */
    public function validatevalidEnum($attribute, $value, $params)
    {
        try {
            list($Enum) = $params;
            $class_name = "App\Enums\\" . $Enum;
            $request = Request::all();

            if ($class_name::fromValue((int) $value)) {
                return true;
            }
        } catch (InvalidEnumMemberException $ex) {
            return false;
        }
    }

    /**
     * recordExists function
     *
     * @param [type] $attribute
     * @param [type] $value
     * @param [type] $params
     * @return void
     */
    public function validaterecordExists($attribute, $value, $params)
    {
            if($value == NULL){
                return true;
            }
            
            list($model,$key)   = $params;
            $class_name         = "App\Models\\" . $model; 
            $_records            =  $class_name::where($key, $value);

            return $_records->count() > 0;
    }


    public  function validatetrim($attribute, $value)
    {
        return TRUE;
    }

    public  function validateisApproved($attribute, $value)
    {   
        $_records            =  DriverAssociatedWithCompany::find($value);
        if($_records){
            return $_records->status_enum_id  ==  Status::APPROVED || $_records->status_enum_id  ==  Status::IN_SERVICE || $_records->status_enum_id  ==  Status::NOT_OPERATING;
        }
        return false;
    }

    public  function validatevalidCompanyId($attribute, $value)
    {   
        if(APIRoleManagement::current_user()){
            return APIRoleManagement::current_user()->company_id == $value; 
        }
        return true;
    }
    
    public  function validateisNewCompany($attribute, $value)
    {    
        if(APIRoleManagement::current_user()){
            return APIRoleManagement::current_user()->current_associated_with_company->company->id != $value; 
        }
        return true;
    }
    

    public function validateCheckBase64Image($attribute, $value) 
    {   
        if($value == null)
        {
            return true;
        }
        $base64  = explode("base64,",$value);

        if(count($base64) < 2 ){
            return false;
        }

        $base64  = $base64[1];
        $img = imagecreatefromstring(base64_decode($base64));
        if (!$img) {
            return false;
        }

        imagepng($img, 'tmp.png');
        $info = getimagesize('tmp.png');
        unlink('tmp.png');

        if ($info[0] > 0 && $info[1] > 0 && $info['mime']) {
            return true;
        }

        return false;
    }
}
