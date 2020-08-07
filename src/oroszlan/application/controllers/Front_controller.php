<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Front_controller extends Public_controller {

    public function index() {
        try {
            $this->load->view("index", array("kisnyul" => 1));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    /**
     * page request handler
     * @param string $module
     * @param string $controller
     * @param string $action
     */
    public function page($module = null, $controller = null, $action = null) {
        try {
            echo json_encode(array("ok"=>1));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
