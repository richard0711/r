<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends Public_controller {

    public function index() {
        try {
            $this->load->view("login", 
                array(
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function forgotPassword() {
        try {
            $this->load->view("forgot-password", 
                array(
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
