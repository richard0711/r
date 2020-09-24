<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Content_controller extends Private_controller {
    
    public function __construct() {
        parent::__construct();
        //load the needed libs, models, etc...
        $this->load->library("Curl");
        $this->load->library("AdminAPI");
    }

    public function contentList() {
        try {
            $AdminAPI = new AdminAPI();
            $list = $AdminAPI->get('contents', array("limit"=>10,"offset"=>0));
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/content/list', 
                        array(
                            'list' => $list
                        ), 
                        true
                    )
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function newContent() {
        try {
            $AdminAPI = new AdminAPI();
            $positions = $AdminAPI->get('positions', array("type"=>'content'));
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/content/new', 
                        array(
                            "positions" => $positions
                        ), 
                        true
                    )
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function editContent($idcontent) {
        try {
            $AdminAPI = new AdminAPI();
            $content = $AdminAPI->get('content/'.$idcontent);
            $positions = $AdminAPI->get('positions', array("type"=>'content'));
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/content/edit', 
                        array(
                            "content" => $content,
                            "positions" => $positions
                        ), 
                        true)
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function delContent($idcontent = 1) {
        try {
            $AdminAPI = new AdminAPI();
            $content = $AdminAPI->get('content/'.$idcontent);
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/content/del', 
                        array(
                            "content" => $content
                        ), 
                        true)
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
