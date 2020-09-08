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
            $this->output->set_status_header($exc->getCode(), $exc->getMessage());
        }
    }

}

class Private_controller extends MY_Controller {

    public $token;

    public function __construct() {
        parent::__construct();
        try {
            $this->checkLoginStatus();
        } catch (Exception $exc) {
            $this->output->set_status_header($exc->getCode(), $exc->getMessage());
        }
    }

    private function checkLoginStatus() {
    /**
     * 
     
        log_message('debug', 'checkLoginStatus HEADER !' . print_r($this->input->get_request_header('Token'), true));
        log_message('debug', 'checkLoginStatus GET !' . print_r($this->input->get('Token'), true));
        log_message('debug', 'checkLoginStatus POST !' . print_r($this->input->post('Token'), true));
        $this->token = $this->input->get_request_header('Token');
        log_message('debug', 'Token-header: ' . $this->token);
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
        //itt kell az auth api-t hívni!
        $this->config->set_item('token', $this->token);*/
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
