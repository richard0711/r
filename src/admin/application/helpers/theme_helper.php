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

function formatted_date_time($date_time = '', $with_time = false, $format = '') {
    $formatteddatetime = $date_time;
    if ($format != '') {
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