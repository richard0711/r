<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_controller extends Private_controller {

    public function index() {
        try {
            $this->load->view("index");
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
