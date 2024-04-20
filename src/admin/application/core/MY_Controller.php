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
            
        } catch (Exception $exc) {
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }
    
    protected function handleError(Exception $exc) {
        $this->load->library('ErrorResponse');
        $response = new ErrorResponse();
        $response->setError($exc, $this->output);
        exit;
    }

}

class Private_controller extends MY_Controller {

    public $token;

    public function __construct() {
        parent::__construct();
        try {
            $this->checkLoginStatus();
        } catch (Exception $exc) {
            $this->handleError($exc);
        }
    }

    private function checkLoginStatus() {
        log_message('debug', 'checkLoginStatus HEADER !' . print_r($this->input->get_request_header('Token'), true));
        log_message('debug', 'checkLoginStatus GET !' . print_r($this->input->get('Token'), true));
        log_message('debug', 'checkLoginStatus POST !' . print_r($this->input->post('Token'), true));
        if (isset($_COOKIE[config_item('cookie_prefix') . 'Token'])) {
            $this->token = $_COOKIE[config_item('cookie_prefix') . 'Token'];
        }
        if (empty($this->token)) {
            $this->token = $this->input->get_request_header('Token');
            log_message('debug', 'Token-header: ' . $this->token);
        }
        if (empty($this->token)) {
            $this->token = $this->input->get('Token');
            log_message('debug', 'Token-GET: ' . $this->token);
        }
        if (empty($this->token)) {
            $this->token = $this->input->post('Token');
            log_message('debug', 'Token-POST: ' . $this->token);
        }
        log_message('debug', 'checkLoginStatus token : ' . print_r($this->token, true));
        if (empty($this->token)) {
            throw new Exception('Érvénytelen kliens kulcs!', 403);
        }
        $HTTPHEADER = array(     
            'Content-Type: application/json',
            'Token: '.$this->token,
            'System: oroszlangy'
        );
        $curl = get_curl($HTTPHEADER);
        $resultJSON = $curl->simple_get(config_item('auth_api')."tokeninfo", array(
            "Token" => $this->token,
            "System" => 'oroszlangy',
        ), array(CURLOPT_USERAGENT => true));
        log_message('debug', 'auth $curl->info'.print_r($curl->info, true));
        $status_code = $curl->info["http_code"];
        if ($status_code == 200) {
            $dec_json = json_decode($resultJSON, true);
            $this->config->set_item('token', $this->token);
            $this->config->set_item('iduser', $dec_json["data"]["iduser"]);
            $this->config->set_item('username', $dec_json["data"]["name"]);
        } else {
            throw new Exception("Hozzáférés megtagadva!", 403);
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
