<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News_controller extends Private_controller {

    public function newsList() {
        try {
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/news/list', array(), true)
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function newNews() {
        try {
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/news/new', array(), true)
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
