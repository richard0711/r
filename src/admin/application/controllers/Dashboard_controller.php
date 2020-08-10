<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_controller extends Private_controller {

    public function index() {
        try {
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('partials/dashboard', array(), true)
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
