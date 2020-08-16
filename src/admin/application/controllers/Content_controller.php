<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Content_controller extends Private_controller {

    public function contentList() {
        try {
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/content/list', array(), true)
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function newContent() {
        try {
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/content/new', array(), true)
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
