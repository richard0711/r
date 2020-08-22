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
        $url = FULL_BASE_URL.'content/'.$menu_item["idcontent"];
    } else if ($menu_item["url"] != '') {
        $url = $menu_item["url"];
    }
    return $url;
}

