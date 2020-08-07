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