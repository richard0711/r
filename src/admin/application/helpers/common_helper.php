<?php

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
        $Curl->option('FAILONERROR', (isset($options["FAILONERROR"])) ? $options["FAILONERROR"] : false);
        $Curl->option('RETURNTRANSFER', (isset($options["RETURNTRANSFER"])) ? $options["RETURNTRANSFER"] : true);
        $Curl->option('TIMEOUT', (isset($options["TIMEOUT"])) ? $options["TIMEOUT"] : 120);
        $Curl->option('HTTPHEADER', $HTTPHEADER);
        $Curl->option('USERAGENT', true);
        return $Curl;
    }
}