<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Partial Helper
 *
 * Loads the partial
 *
 * @access		public
 * @param		mixed    file name to load
 */
function file_partial($file = '', $ext = 'php') {
    $CI = & get_instance();
    $data = $CI->load->get_vars();
    $path = ((isset($data['template_views'])) ?: '') . 'partials/' . $file;
    echo $CI->load->view($path, $data, true);
}

/**
 * get menu item url by param
 * @access		public
 */
function getMenuItemURL($menu_item = array()) {
    //if idcontent > 1 then link to content
    //if url != then link to url
    //else link : javascript:void(0);
    $url = '#';
    if ($menu_item["idcontent"] > 1) {
        $url = FULL_BASE_URL.'p/content/'.$menu_item["idcontent"];
    } else if ($menu_item["idgallery"] > 1) {
        $url = FULL_BASE_URL.'p/gallery/'.$menu_item["idgallery"];
    } else if ($menu_item["url"] != '') {
        $url = $menu_item["url"];
    }
    return $url;
}

function formatted_date_time($date_time = '', $with_time = false, $format = '', $lang = '') {
    if ($lang == 'hun') {
        $date_time_slices = explode(" ", $date_time);
        $timestamp = strtotime($date_time_slices[0]);
        $honapok = Array( "", "január" , "február"  , "március"   ,
	                      "április", "május"    , "június"    ,
	                      "július" , "augusztus", "szeptember",
	                      "október", "november" , "december"    );
        //	$napok   = Array( "vasárnap" , "hétfő" , "kedd",  "szerda",
        //	                  "csütörtök", "péntek", "szombat"          );
	$ho   =  $honapok[date("n", $timestamp)];
        //	$nap  =  $napok[date("w", $timestamp)];
	return date("Y. ", $timestamp) . $ho . date(" d.", $timestamp);
    }
    
    $formatteddatetime = $date_time;
    if ($format != '' && $lang == '') {
        $date_time = str_replace(".", "-", $date_time);
        $date_time_in_sec = strtotime($date_time);
        $formatteddatetime = date($format, $date_time_in_sec);
    } else {
        $date_time = str_replace("-", ".", $date_time);
        if (!$with_time) {
            $date_time_slices = explode(" ", $date_time);
            if (is_array($date_time_slices) && count($date_time_slices) > 0) {
                $formatteddatetime = $date_time_slices[0];
            }
        }
    }
    return $formatteddatetime;
}