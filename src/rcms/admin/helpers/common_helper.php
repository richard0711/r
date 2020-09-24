<?php

if (!function_exists('set_query_limit_and_offset'))
{
    function set_query_limit_and_offset($filter = array(), $db = NULL)
    {
        log_message('debug', 'set_query_limit_and_offset'.print_r($filter, true));
        $offset = NULL;
        $limit = NULL;
        if ($db != NULL) {
            if (array_key_exists("offset", $filter) && $filter["offset"] >= 0) {
                $offset = $filter["offset"];
            }
            if (array_key_exists("limit", $filter) && $filter["limit"] > 0) {
                $limit = $filter["limit"];
            }
            if ($limit !== NULL && $offset !== NULL) {
                $db->limit($limit, $offset);
            } 
        }
    }
}

if (!function_exists('sanitize_filename'))
{
    function sanitize_filename($string = "")
    {
        $bad='/[\/:*?"<>|]/';
        return preg_replace($bad,"",$string);
    }
}

if (!function_exists('get_curl')) 
{
    function get_curl($options = array()) 
    {
        if (isset($options['HTTPHEADER'])) {
            $HTTPHEADER = $options['HTTPHEADER'];
        } else {
            $HTTPHEADER = array(     
                'Content-Type: application/json'
            );
        }
        $Curl = new Curl();
        $Curl->option('CONNECTTIMEOUT_MS', (isset($options["CONNECTTIMEOUT_MS"])) ? $options["CONNECTTIMEOUT_MS"] : 120000);
        $Curl->option('SSL_VERIFYHOST', (isset($options["SSL_VERIFYHOST"])) ? $options["SSL_VERIFYHOST"] : false);
        $Curl->option('SSL_VERIFYPEER', (isset($options["SSL_VERIFYPEER"])) ? $options["SSL_VERIFYPEER"] : false);
        $Curl->option('FAILONERROR', false);
        $Curl->option('RETURNTRANSFER', (isset($options["RETURNTRANSFER"])) ? $options["RETURNTRANSFER"] : true);
        $Curl->option('TIMEOUT', (isset($options["TIMEOUT"])) ? $options["TIMEOUT"] : 120);
        $Curl->option('HTTPHEADER', $HTTPHEADER);
        $Curl->option('USERAGENT', true);
        return $Curl;
    }
}