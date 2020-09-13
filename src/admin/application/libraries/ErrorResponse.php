<?php

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}
/**
 * @package	Vizugy admin
 * @copyright	Copyright (c) 2017
 * @since	Version 1.0
 * @filesource  ./libraries/ErrorResponse.php
 */

/**
 * ErrorResponse
 */
class ErrorResponse 
{

    public function setData($data){}
    
    public function getData(){}
    
    public function setOutput(CI_Output $output){
        $output->set_status_header(500, 'Ismeretlen kivétetel.');
    }

    public function setError(Exception $data, CI_Output $output){
        $output->set_content_type('application/json');
        $message = $data->getMessage();
        $output_array = array(
            "error" => (int)$data->getCode(),
            "message" => $data->getMessage()
        );
        log_message('debug', 'setError error: '.print_r($data->getCode(), true));
        log_message('debug', 'setError output_array: '.print_r($output_array, true));
        if ($output_array["error"] == 403) {
            header("Location: ". config_item('login_url'));
            exit;
        }
        $output->set_status_header((int)$data->getCode(), $message);
        $output->set_output(json_encode($output_array));
        $output->_display($output->final_output);
    }
    
}

/* end of file ErrorResponse.php */
/* Location: ./libraries/ErrorResponse.php */