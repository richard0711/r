<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends Public_controller {

    public function login() {
        try {
            echo json_encode(array("ok"=>1));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
