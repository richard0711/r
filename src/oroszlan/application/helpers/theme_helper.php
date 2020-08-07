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