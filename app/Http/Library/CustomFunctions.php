<?php

namespace App\Http\Library;

use App\Http\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Session;

use App\Http\Helpers\DropdownHelper;
use App\CmsMenu;
use App\Locations;
use App\Models\SiteSetting;
use Auth;


class CustomFunctions
{

    static function getUserDetails($CHECK_login_type, $id)
    {
        if ($CHECK_login_type == \Config::get("constants.GUARD_PROJECTSUBSCRIBER")) {
            $_A            = \App\ProjectMembers::where("id", $id);
            $_B            = FALSE;
        } else {
            $_A         = \App\Admin::where("id", $id);
            $_B            =  TRUE;
        }

        return [
            "is_admin"        => $_B,
            "user_details"    => $_A
        ];
    }

    static function returnArray_ForBot($_user_id = FALSE, $_api_key = FALSE, $message = FALSE, $_save_this_text_in_database = "", $_save_response_text_in_database = "", $_show_this_text_on_app = "", $_show_response_on_app = "", $_rememberMessageOptions = FALSE)
    {
        $Req = new \Illuminate\Http\Request();
        $Req->setMethod('POST');
        $Req->request->add(["user_id"                    => $_user_id]);
        $Req->request->add(["api_key"                    => $_api_key]);
        $Req->request->add(["message"                    => $message]);

        $Req->request->add(["save_this_text_in_database"                => $_save_this_text_in_database]);
        $Req->request->add(["save_response_text_in_database"            => $_save_response_text_in_database]);

        $Req->request->add(["show_this_text_on_app"    => $_show_this_text_on_app]);
        $Req->request->add(["show_response_on_app"        => $_show_response_on_app]);

        $Req->request->add(["rememberMessageOptions"    => $_rememberMessageOptions]);


        return  $Req;
    }

    static function returnApp_Response($_userName, $_senderId, $_message, $_message_type, $_is_bot = FALSE, $_show_chat = TRUE, $_needs_help = FALSE, $_rememberMessageOptions = FALSE, $_sent_from_human = FALSE)
    {
        $response                         = array(
            "userName"                  => $_userName,
            "senderId"                  => $_senderId,
            "message1"                    => ($_message),
            "message_type"              => $_message_type,
            'timestamp'                 => time(),
            "is_bot"                    => $_is_bot,
            "show_chat"                    => $_show_chat,
            "needs_help"                => $_needs_help,
            "rememberMessageOptions"    => $_rememberMessageOptions,
            "sent_from_human"            => $_sent_from_human
        );

        return $response;
    }


    static function getDataTableLENGTH()
    {
        return     json_encode([[10, 25, 50, -1], [10, 25, 50, "All"]]);
    }


    static function getDataTableDOM($custom_syntax = false, $other_syntax = false, $show_custom_datatable_loader = TRUE)
    {
        if ($custom_syntax) {
            $MultiArray            = $custom_syntax;
        } else {
            $MultiArray            = array(
                array(
                    array(
                        "size"        => 6,
                        "value"        => "l"
                    ),

                    array(
                        "size"        => 6,
                        "value"        => "f"
                    )
                ),


                array(
                    array(
                        "size"        => 6,
                        "value"        => "i"
                    ),

                    array(
                        "size"        => 6,
                        "value"        => "p"
                    )
                ),

                array(
                    array(
                        "size"        => 12,
                        "value"        => "t"
                    ),

                    array(
                        "size"        => 12,
                        "value"        => "r"
                    )
                ),

                array(
                    array(
                        "size"        => 6,
                        "value"        => "i"
                    ),

                    array(
                        "size"        => 6,
                        "value"        => "p"
                    )
                ),


            );
        }


        $syntax_code        = '';
        foreach ($MultiArray as $i => $v) {

            $syntax_code        .= '<"row"';
            foreach ($v as $index => $value) {
                if ($value['value'] == "r" and $show_custom_datatable_loader) {
                    $syntax_code    .= '<"col-sm-' . $value['size'] . ' datatTable_lock_loader"' . $value['value'] . '>';
                } else {
                    $syntax_code    .= '<"col-sm-' . $value['size'] . '"' . $value['value'] . '>';
                }
            }
            $syntax_code        .= ">";
        }



        /*
		$syntax_code		= '';
		foreach ($MultiArray as $i => $v)
		{
			$syntax_code		.=	'<"col-sm-6"';
			foreach ( $v as $index => $value )
			{
				$syntax_code	.= '<"col-sm-12"'.$value.'>';
			}
			$syntax_code	.= '>';
		}


		
		$final_DOM = '	<"row"r%s>';
		*/



        return  $syntax_code; #"<'row'<'col-sm-6'l><'col-sm-6'f>> <'row'<'col-sm-12't><'col-sm-12'r>> <'row'<'col-sm-5'i><'col-sm-7'p>>"; #sprintf( $final_DOM, $syntax_code) . "t" . '<"row"r<"col-sm-6"<"col-sm-12"i>><"col-sm-6"<"col-sm-12"p>>>';


        /*
		if ( $custom_syntax )
		{
			return $custom_syntax;	
		}
		if ( count($remove_objects) > 0 )
		{
			foreach (	$remove_objects as $ro)
			{
				if ( in_array( $ro, $tmp_array ) )
				{
					$_KEY		= array_search($ro, $tmp_array);
					unset( $tmp_array[$_KEY] );
				}
			}
		}
		*/

        #return '<"row" ' . implode("", $tmp_array) . '>';
    }


    function generateQRcode($text = false)
    {
        $text = md5($text);
        return 'data:image/png;base64,' . DNS2D::getBarcodePNG($text, "QRCODE", 5, 5);
    }



    public function redirect_after_save($request, $redirect_to_default, $redirect_to_add, $redirect_to_edit)
    {
        if ($request->save_and_add_new) {
            $uri = $redirect_to_add;
        } else if ($request->save_and_edit) {

            $uri = $redirect_to_edit;
        } else {

            $uri = $redirect_to_default;
        }

        return $uri;
    }


    static function getCategoriesTreeArray($filter_array, $parentId, $isChild, $indexId, &$fillArray, $OTHER_array = array())
    {
        $allCats                             = CmsMenu::where("id", ">", 0);


        if ($filter_array) {
            $allCats->where("positionid", $filter_array);
        }

        $allCats->where('parentid', $parentId);
        $allCats->orderBy("sort", "ASC");


        $class                              = ($isChild) ? "sub-cat-list" : "cat-list";
        @$html                              .= '<ul class="' . $class . '">';

        if ($isChild) {
            $indexId                        = ($indexId . $indexId);
            $include_seperator              = $indexId;
        } else {
            $include_seperator            = "";
        }




        foreach ($allCats->get() as $category) {
            $load_subcats       = CmsMenu::where("parentid", $category->id)->orderBy("sort", "ASC");
            $subcats            = $load_subcats->count();


            $dumparray                          = $category->toArray();
            $dumparray["newName"]               = $include_seperator . $category->name;

            if (array_key_exists('get_TreeData', $OTHER_array)) {

                $__category_NAME                            = $category->name . ' ( ' . $category->slug . ' )';
                $fillArray[$category->id]                   = array(
                    "id"             => $category->id,
                    "text"             => $__category_NAME
                );

                $fillArray[$category->id]["type"]        = "not-active";


                if ($category->status) {
                    $fillArray[$category->id]["type"]    = "active";
                    #$fillArray[ $category->getId() ]["type"]    = "active";
                }

                $fillArray[$category->id]["contentenable"]    = "0";
                if (\App\CmsContent::where("menuid", $category->id)->count() > 0) {
                    $fillArray[$category->id]["contentenable"]    = "1";
                }




                #GET DEFAULT COMMISSIONS FOR CATEGORIES
                $TMP_hidden_input                = "";

                if (array_key_exists("extra_condition", $OTHER_array)) {
                    if ($OTHER_array['extra_condition'] == "cmsmenuwithcontent") {
                    }
                }


                /* FOR DEFAULT */
                $haveChild                          = false;
                if ($subcats) {
                    $fillArray[$category->id]["children"]    = TRUE;
                    $haveChild                                     = TRUE;
                }
            } else {
                $fillArray[$category->id]    = $dumparray;
            }



            $html .= '<li>' . $category->name . "";

            if ($subcats != '') {
                if (array_key_exists('show_ParentOnly', $OTHER_array)) {
                } else {
                    $html .= self::getCategoriesTreeArray($filter_array, $category->getId(), true, $indexId, $fillArray, $OTHER_array);
                }
            }
            $html .= '</li>';
        }
        $html .= '</ul>';


        if (array_key_exists('is_HTML', $OTHER_array)) {
            return $html;
        } else {
            return $fillArray;
        }
    }





    static function set_link_attributes($TMP = array(), $TMP_content = FALSE, $append_slug = FALSE)
    {
        if ($append_slug) {
            $append_slug            .= "/";
        }




        $TMP_TYPES                                = \App\CmsMenuTypes::where("id", $TMP["typeid"])->select("name as type_name");
        $TMP_TYPES                                = $TMP_TYPES->get()->first();

        $TMP["type_name"]                        = $TMP_TYPES->type_name;




        if ($TMP["type_name"] == "content") {
            $href                            = url($append_slug .  $TMP["slug"]);
        } else if ($TMP_content->count() > 0) {

            if ($TMP["type_name"] == "url_internal") {
                $href                        = url($TMP_content->get()->first()->content);
            } else {
                $href                        = $TMP_content->get()->first()->content;
            }
        } else {
            $href                        = "javascript:;";
        }



        $short_desc                        = FALSE;
        $content                        = FALSE;
        if ($TMP_content->count() > 0) {
            $short_desc                    = $TMP_content->get()->first()->short_desc;
            $content                    = $TMP_content->get()->first()->content;
        }

        return array(
            "href"            => $href,
            "target"        => $TMP['target'],
            "name"            => $TMP['name'],
            "short_desc"    => $short_desc,
            "content"        => $content
        );
    }

    static function formatTree($tree, $parent)
    {
        $tree2 = array();


        foreach ($tree as $i => $item) {
            if ($item['parentid'] == $parent) {
                $tree2[$item['id']] = $item;
                $tree2[$item['id']]['submenu']         = self::formatTree($tree, $item['id']);
            }
        }

        return $tree2;
    }


    static function buildTree($elements, $position_name, $parentId = 0)
    {
        $branch                        = array();

        $append_slug                = "page";

        foreach ($elements as $element) {
            if ($element["parentid"] == $parentId) {
                $TMP_menus                        = \App\CmsMenu::where("positionid", function ($q) use ($position_name) {

                    $q->select('id')
                        ->from(with(new \App\CmsMenuPositions)->getTable())
                        ->where('name', $position_name);
                })->where("parentid", $element["id"])->where("status", 1)->orderBy('sort', 'ASC');

                $children                         = self::buildTree($TMP_menus->get()->toArray(), $position_name, $element["id"]);



                $TMP_content                    = \App\CmsContent::where("menuid", $element["id"]);
                $TMP_attributes                    = self::set_link_attributes($element, $TMP_content, "page");


                if (count($children) > 0) {
                    $TMP_attributes['child']             = $children;
                    #$element['child'] = $children;
                }




                $branch[]                                 = $TMP_attributes;
                #$branch[] = $element;
            }
        }


        return $branch;
    }


    static function topmenunavigation($position_name = "", $parentid = NULL)
    {
        $TMP_menus                    = \App\CmsMenu::where("positionid", function ($q) use ($position_name) {

            $q->select('id')
                ->from(with(new \App\CmsMenuPositions)->getTable())
                ->where('name', $position_name);
        })->where("parentid", $parentid)->where("status", 1)->orderBy('sort', 'ASC');






        $FULL_menus                    = self::buildTree($TMP_menus->get()->toArray(), $position_name, NULL);


        return $FULL_menus;
    }


    static function check_if_date_is_optional($date, $format)
    {
        if ($date == $format || $date == "") {
            return TRUE;
        }

        return false;
    }


    static function datatable_filterColumn(&$query, $keyword, $Where_Key, $TMP_array)
    {
        if (is_numeric($keyword)) {
            $query->where($Where_Key, $keyword);
        } else {
            foreach ($TMP_array as $__key => $__value) {
                $TMP_array[$__key]    = strtolower($__value);
            }

            $TMP_result         = preg_grep('~' . $keyword . '~', $TMP_array);
            foreach ($TMP_result as $__key => $__value) {
                $query->orWhere($Where_Key, $__key);
            }
        }
    }

    static public function get_SiteSettings_data()
    {
        $edit_details = SiteSetting::first();

        return $edit_details;
    }

    static public function removeArrayValue(array $arr, array $remove_values, bool $is_associative_array = true ) : array
    {   
        if(!$is_associative_array){
            $remove_values = array_flip($remove_values);
        }
       return array_diff_key($arr,$remove_values);  
    }

    static public function autoGeneratedPassword() : string
    {   
        $string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+|}{[]:;?><-=";
        $randomPassword = "";
        for ($i = 0; $i < 16; $i++) {
            $randomPassword  .=   substr($string,rand(0,strlen($string)),1);
        }  
        return  $randomPassword;
    }

    static public function remove_files_form_request(&$request , $filename){
        $request->files->remove($filename);
    }
}
