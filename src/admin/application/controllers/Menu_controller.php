<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_controller extends Private_controller {

    public function menuList() {
        try {
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/menu/list', array(), true)
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function newMenu() {
        try {
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/menu/new', array(), true)
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
