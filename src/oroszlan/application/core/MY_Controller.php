<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MY_Controller extends CI_Controller {

    public $token = null;
    public $client = array();

    public function __construct() {
        parent::__construct();
        try {
            header('Access-Control-Allow-Origin: ' . 
                (isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '*'));
            header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, "
                . "Content-Type, Accept, Access-Control-Request-Method, Token");
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
            header('Access-Control-Allow-Credentials: true');

            $this->output->set_content_type('application/json');
            $this->load->helper('security');
            $this->decodeRequest();
        } catch (Exception $exc) {
            $this->output->set_status_header($exc->getCode(), $exc->getMessage());
        }
    }

    protected function decodeRequest() {
        $method = strtoupper($this->input->server('REQUEST_METHOD'));
        if (strtoupper($method) === 'OPTIONS') {
            exit(0);
        }
        $rawRequest = file_get_contents('php://input');
        $request = json_decode(xss_clean(trim($rawRequest)), true);
        if (!empty($request)) {
            if (ENVIRONMENT == 'development') {
                log_message("debug", "raw request: " . print_r($rawRequest, true));
                log_message("debug", "decoded request: " . print_r($request, true));
            }
            switch ($method) {
                case 'POST':
                case 'PUT':
                case 'PATCH':
                    $_POST = (array) $request;
                    break;
                case 'GET':
                case 'DELETE':
                    $_GET = (array) $request;
                    break;
                default:
                    break;
            }
        } else {
            if (ENVIRONMENT == 'development') {
                log_message("debug", "_POST : " . print_r($this->input->post(), true));
                log_message("debug", "_GET : " . print_r($this->input->get(), true));
            }
        }
    }

}

class Private_controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
        try {
          
        } catch (Exception $exc) {
            $this->output->set_status_header($exc->getCode(), $exc->getMessage());
        }
    }

}

class Public_controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
        try {
          
        } catch (Exception $exc) {
            $this->output->set_status_header($exc->getCode(), $exc->getMessage());
        }
    }

}