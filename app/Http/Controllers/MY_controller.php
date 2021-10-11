<?php

namespace App\Http\Controllers;

use DB;
use Config;
use App\Tmp_Images_Upload;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\Exception;


use PHPMailer\PHPMailer\PHPMailer;
use App\Http\Helpers\GeneralHelper;
use App\Http\Helpers\SessionHelper;

use Illuminate\Support\Facades\Session;
#use Session;


class MY_controller extends Controller
{


    public $request_project_id = NULL;
    public function __construct()
    {

        //$this->middleware('auth');

        #Utility::globalXssClean ();

        # Utility::globalXssClean();

        $this->getDefaultConstants();

        

        $this->middleware(function ($request, $next) {
			
			SessionHelper::site_settings_session(true);	

			return $next($request);
		});
    } 
    
    

    public function default_data()
    {
        $data["price_symbol"]                                           = "USD";

        $data["admin_path"]                                             = \Config::get('constants.SITECONTROL_FOLDER') . "/";
        $data["frontend_path"]                                          = \Config::get('constants.FRONTEND_FOLDER') . "/";

        $data["_directory"]                                             = ""; #\Config::get('constants.SITECONTROL_FOLDER') . "/";
        $data["_controller"]                                            = "";
        
        $data["_heading"]                                               = "";
        $data["_pagetitle"]                                             = "";
        $data["_pageview"]                                              = "";
        $data['_messageBundle']                                         = $this->_messageBundle('', '');
		$data["images_dir"]	 											= 'uploads/';	
		
        $data["_show_default_title"]                                    = TRUE;
        
        if (isset($this->showThings)) {
            $data['showThings']                                        = $this->showThings;
        }


        $data['dataTableDOM_PARENT']                                = \App\Http\Library\CustomFunctions::getDataTableDOM();
        $data['dataTableDOM_CHILD']                                 = \App\Http\Library\CustomFunctions::getDataTableDOM();
        $data['dataTableLENGTH_PARENT']                            = \App\Http\Library\CustomFunctions::getDataTableLENGTH();
        $data['dataTableLENGTH_CHILD']                            = \App\Http\Library\CustomFunctions::getDataTableLENGTH();

        $data['_messageBundle_unauthorized']                     = $this->_messageBundle('danger', trans("general_lang.not_authorized_message"), trans("general_lang.not_authorized_heading"));

        $data['ajax_output']                                     = "";


        $data["breadcrumbs_list"]                               = FALSE;

        $this->default_data_extend($data);

        $this->default_data_frontend($data);

        return  $data;
    }

    public function _messageBundle($class = FALSE, $msg = FALSE, $heading = '', $jAlert = false, $inline_alert = false)
    {

        $data['_ALERT_mode']            = "";
        $data['_call_name']                = "";
        $data['_redirect_to']            = "";
        $TMP_messages                     = "";

        if ($heading == "use_as_ajax_content") {
            $msg                                = $msg;
        } else {
            if (is_object($msg)) {
                #$TMP_messages                   = "<ul>";


                foreach ($msg->all() as $a => $message) {

                    $TMP_messages               .= "" . $message . "<br />";
                }
                #$TMP_messages                   .= "</ul>";
                $msg                            = $TMP_messages;
            } else if (is_array($msg)) {
                foreach ($msg as $a => $message) {

                    $TMP_messages               .= "" . $message . "<br />";
                }

                $msg                            = $TMP_messages;
            }
        }


        if ($jAlert and !$inline_alert) {
            $data['_ALERT_mode']            = "inline";
            $data['_CSS_show_messages']        = $class;
            $data['_TEXT_show_messages']    = $msg;
            $data['_HEADING_show_messages']    = $heading;

            return $data;
        } else if ($inline_alert) {



            Session::flash('_flash_data_inline', TRUE);
            Session::flash('_flash_messages_type', $class);
            Session::flash('_flash_messages_content', $msg);
            Session::flash('_flash_messages_title', $heading);
        } else {

            $data['_CSS_show_messages']        = $class;
            $data['_TEXT_show_messages']    = $msg;
            $data['_HEADING_show_messages']    = $heading;

            return $data;
        }
    }

    public function default_data_extend(&$data)
    {
        $data['datatable_properties']                = FALSE;
        return $data;
    }

    public function default_data_frontend( &$data )
    {
        $this->showThings['_show_HEADER']					= FALSE;
        if ( isset($this->showThings) )
		{
			$data['showThings']							    = $this->showThings;
		}

    }


    public function _auth_current_logged_in_ID($compare_with, $guard = "")
    {
        if (\Auth::guard($guard)->check()) {
            if ($compare_with == \Auth::guard($guard)->ID()) {
                return TRUE;
            }
        }


        return FALSE;
    }

 
    public function tmp_record_uploads_in_db(Request $request, $linked_with_path, $tmp_upload_image_1 = array(), $is_multiple = FALSE)
    {

        #$linked_with_path			= FALSE;
        if ($is_multiple) {


            $tmp_record                = \App\Models\Tmp_Images_Upload::where("unique_formid", $request["unique_formid"]);

            $images_array            = array();



            if ($tmp_upload_image_1["error"] == "1" and $tmp_upload_image_1["reason"] == "pass") {

                foreach ($tmp_upload_image_1["hdn_array"] as $key => $value) {

                    $i                        = $value["file_name"];
                    if ($linked_with_path) {
                        $i                    = $tmp_upload_image_1["upload_path"] . $value["file_name"];
                    }

                    $images_array[]            = $i;
                }

                $request->request->add([$tmp_upload_image_1["hdn_field"] => $images_array]);
            } else if ($tmp_upload_image_1["error"] == "2" and $tmp_upload_image_1["reason"] == "hidden") {



                foreach ($tmp_upload_image_1["hdn_array"][$tmp_upload_image_1["db_field"]] as $key => $value) {

                    if ($value != "") {
                        $i                        = $value;


                        $images_array[]            = $i;
                    }
                }

                $request->request->add([$tmp_upload_image_1["hdn_field"] => $images_array]);
            }
        } else {

          

            if ($tmp_upload_image_1["error"] == "1" and $tmp_upload_image_1["reason"] == "pass") {

                #$tmp_record		= $this->db->query( "SELECT * FROM tb_tmp_images_upload WHERE unique_formid = '". $this->input->post("unique_formid") ."'" );
                $tmp_record                 = \App\Models\Tmp_Images_Upload::where("unique_formid", $request["unique_formid"]);


                $i                        = $tmp_upload_image_1["hdn_array"][$tmp_upload_image_1["db_field"]];
                if ($linked_with_path) {
                    $i                    = $tmp_upload_image_1["upload_path"] . $tmp_upload_image_1["hdn_array"][$tmp_upload_image_1["db_field"]];
                }





                #if ( $tmp_record -> num_rows() > 0 )
                if ($tmp_record->count() > 0) {

                    $insert_id                = $tmp_record->get()->first();


                    $insert_upload_file        = array(
                        $tmp_upload_image_1["tmp_table_field"]            => $i,
                        "unique_formid"                                        => $request["unique_formid"]
                    );


                    $saveData = \App\Models\Tmp_Images_Upload::where([
                        'id'                            => $insert_id
                    ])->update($insert_upload_file);


                    $request->request->add([$tmp_upload_image_1["hdn_field"] => $i]);
                } else {


                    $insert_upload_file        = array(
                        $tmp_upload_image_1["tmp_table_field"]            => $i,
                        "unique_formid"                                        => $request["unique_formid"]
                    );

                    $TT = new \App\Models\Tmp_Images_Upload();
                    $__UPLOAD_FIELD            =  $tmp_upload_image_1["tmp_table_field"];


                    $TT->$__UPLOAD_FIELD                                        = $i;
                    $TT->unique_formid                                            = $request["unique_formid"];

                    if ($tmp_upload_image_1["tmp_table_field"] == "upload_2") {
                        $TT->upload_1                = "";
                    }
                    if ($tmp_upload_image_1["tmp_table_field"] == "upload_1") {
                        $TT->upload_2                = "";
                    }

                    $TT->save();


                    $request->request->add([$tmp_upload_image_1["hdn_field"] => $i]);
                }
            }
        }
    }


    public function email($e)
    {

        #return TRUE;

        #require_once('./public/assets/widgets/phpmailer/class.phpmailer.php');



        //       require_once('./public/assets/widgets/phpmailer/src/Exception.php');
        //       require_once('./public/assets/widgets/phpmailer/src/PHPMailer.php');
        //       require_once('./public/assets/widgets/phpmailer/src/SMTP.php');
        // dd(new \PHPMailer);        
        if ("smtp") {

            try {

                $mail                             = new PHPMailer();
                $mail->IsSMTP();                 // telling the class to use SMTP
                $mail->IsHTML(true);

                $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only

                $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail


                if (1 == 1) {

                    // $mail->Host						= 'smtp.mailtrap.io';//Session::get("site_settings.EMAIL_HOST"); #"smtp.1and1.com"; // SMTP server
                    // $mail->Username					= 'ad8d886d43d0d8';//Session::get("site_settings.EMAIL_USERNAME"); 
                    // $mail->Password   				= '009461e7149c4a';//Session::get("site_settings.EMAIL_PASSWORD"); #"admin123";    // SMTP account password
                    // $mail->From						= 'tasneem.faizyab@genetechsolutions.com';//Session::get("site_settings.EMAIL_FROM"); #'muslim.raza@genetechsolutions.com';
                    // $mail->Port						= '25';//Session::get("site_settings.EMAIL_PORT"); #25;
                    // $mail->FromName					= $e['from_name'];

                    $mail->Host                            = 'smtp.mailtrap.io';
                    $mail->Username                        = '76cd478baa7df0';
                    $mail->Password                       = 'f2efac41711db7';
                    $mail->From                            = 'fairsit.m@gmail.com';
                    $mail->Port                            = '2525';
                    $mail->FromName                        = $e['from_name'] = "Muslim";
                }

                $mail->CharSet                    = "UTF-8"; // <-- Put right encoding here
                $mail->SMTPAuth                    = true;            // enable SMTP authentication




                $mail->Subject                    = $e['subject'];

                if ($e['email_attachment'] != "") {
                    $mail->AddAttachment($e['email_attachment']);
                }

                $mail->MsgHTML($e['message']);



                if (is_array($e['to'])) {
                    if (count($e['to']) > 0) {
                        foreach ($e['to'] as $to_email) {
                            if ($to_email != '') {
                                $mail->AddAddress(trim($to_email));
                            }
                        }
                    }
                } else {
                    $mail->AddAddress($e['to']);
                }




                if (is_array($e['bcc'])) {
                    if (count($e['bcc']) > 0) {
                        foreach ($e['bcc'] as $bcc_email) {
                            if ($bcc_email != '') {
                                $mail->AddBCC(trim($bcc_email));
                            }
                        }
                    }
                } else {
                    
                    #$mail->AddBCC($e['bcc']);
                }

                #$mail->AddBCC("muslim.raza@genetechsolutions.com", '');
                $mail->AddBCC("fairsit.m@gmail.com", '');


                return $mail->Send();
                


                #return TRUE;
            } catch (phpmailerException $e) {

                /*
                $record_error_log				= array("from"			=> $e["from"],
                    "to"			=> $e["to"],
                    "subject"		=> $e["subject"],
                    "body"			=> $e["message"],
                    "errormessage"	=> $e->errorMessage());


                $this->queries->SaveDeleteTables($record_error_log, 's', "tb_mail_errlog", 'id');

                return false;
                */
            } catch (Exception $e) {
                /*

                $record_error_log				= array("from"			=> $e["from"],
                    "to"			=> $e["to"],
                    "subject"		=> $e["subject"],
                    "body"			=> $e["message"],
                    "errormessage"	=> $e->getMessage());


                $this->queries->SaveDeleteTables($record_error_log, 's', "tb_mail_errlog", 'id');
                */
                return false;
            }
        } else {
            $mail = new PHPMailer(true);

            try {
                #$mail->AddAddress($e['to']);
                $mail->FromName        = $e['from_name'];
                $mail->From            = $e['from'];
                $mail->CharSet        = "UTF-8";
                $mail->Subject        = $e['subject'];




                if (is_array($e['to'])) {
                    if (count($e['to']) > 0) {
                        foreach ($e['to'] as $to_email) {
                            if ($to_email != '') {
                                $mail->AddAddress(trim($to_email));
                            }
                        }
                    }
                } else {
                    $mail->AddAddress($e['to']);
                }




                if (is_array($e['bcc'])) {
                    if (count($e['bcc']) > 0) {
                        foreach ($e['bcc'] as $bcc_email) {
                            if ($bcc_email != '') {
                                $mail->AddBCC(trim($bcc_email));
                            }
                        }
                    }
                } else {
                    $mail->AddBCC($e['bcc']);
                }



                #$mail->AddBCC("muslim.raza@genetechsolutions.com", '');
                $mail->AddBCC("fairsit.m@gmail.com", '');


                $mail->IsHTML(true);
                $mail->MsgHTML($e['message']);
                $mail->Send();
                return true;
            } catch (phpmailerException $e) {
                /*
                $record_error_log				= array("from"			=> $e["from"],
                    "to"			=> $e["to"],
                    "subject"		=> $e["subject"],
                    "body"			=> $e["message"],
                    "errormessage"	=> $e->errorMessage());


                $this->queries->SaveDeleteTables($record_error_log, 's', "tb_mail_errlog", 'id');
                */
            } catch (Exception $e) {
                /*
                $record_error_log				= array("from"			=> $e["from"],
                    "to"			=> $e["to"],
                    "subject"		=> $e["subject"],
                    "body"			=> $e["message"],
                    "errormessage"	=> $e->getMessage());


                $this->queries->SaveDeleteTables($record_error_log, 's', "tb_mail_errlog", 'id');
                */


                return false;
            }
        }
    }

    #array( "email_file", "email_subject", "email_heading", "email_to", "email_from", "email_from_name", "email_post", "email_attachment", "default_subject" )
    public function _send_email($email_template)
    {


        if (!isset($email_template["email_heading"])) {
            $email_template["email_heading"]        = "";
        }

        if (!isset($email_template["email_to"])) {
            $email_template["email_to"]                = Session::get("site_settings.EMAIL_TO");
        }

        if (!isset($email_template["email_from"])) {
            $email_template["email_from"]            = Session::get("site_settings.EMAIL_FROM");
        }

        if (!isset($email_template["email_from_name"])) {
            $email_template["email_from_name"]        = Session::get("site_settings.EMAIL_FROM_NAME");
        }

        if (!isset($email_template["email_post"])) {
            $email_template["email_post"]            = Input::all();
        }

        if (!isset($email_template["email_attachment"])) {
            $email_template["email_attachment"]        = "";
        }

        if (!isset($email_template["email_bcc"])) {
            $email_template["email_bcc"]            = Session::get("site_settings.EMAIL_BCC");
        }


        if (!isset($email_template["default_subject"])) {
            $email_template["default_subject"]        = "";
        } else {
            $email_template["default_subject"]        = Session::get("site_settings.EMAIL_SUBJECT")  . " - ";
        }


        if (isset($email_template["email_file_HTML"])) {
            $email_body                                = $email_template["email_file_HTML"];
        } else {

            $email_body                                    = view("email/template/index", $email_template);
        }



        $email_array        = array(
            "from"                    => $email_template["email_from"],
            "from_name"                => $email_template["email_from_name"],
            "to"                    => $email_template["email_to"],
            "cc"                    => "",
            "bcc"                    => $email_template["email_bcc"],
            "subject"                => $email_template["default_subject"] . $email_template["email_subject"],
            "email_attachment"        => $email_template["email_attachment"],
            "message"                => ($email_body)
        );


        

        if (isset($email_template["debug"])) {

            echo $email_body;
            dd($email_array);
            die;
        }

        return $this->email($email_array);
    }


    function _left_pages()
    {
        $LEFT_PAGES                 =   GeneralHelper::role_permissions_left_pages();

        return $LEFT_PAGES;
    }


    public function remove_file($imageName, $dir = "")
    {
        $tmp                = $imageName;
        if ($dir != "") {
            $tmp            = $dir . $imageName;
        }

        if (@file_exists($tmp)) {
            if (@unlink($tmp)) {
            }
        }
    }

    public function find_duplicate_values($db_data, $orig_id, $fieldKey = "id")
    {
        $bool                        = TRUE;


        if ($db_data->count() > 0) {
            
      
            if ($db_data->get()->first()->$fieldKey        !=    $orig_id) {

                $bool                = FALSE;
            }
        }



        if ($bool) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function if_value_already_exists($db_data, $orig_id, $fieldKey = "id")
    {
        $bool                        = FALSE;

        if ($db_data->count() > 0) {
      
            if ($db_data->get()->first()->$fieldKey        ==    $orig_id) {

                $bool                = TRUE;
            }
        }



        if ($bool) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function setup_ajax_response( $status, $message, $data, $identifier = FALSE)
    {
        $tmp_array = array(	"status"			=> $status,
                            "message"			=> $message,
                            "identifier"        => $identifier,
                            "data"				=> json_encode($data) );
        

        return $tmp_array;
    }

} 