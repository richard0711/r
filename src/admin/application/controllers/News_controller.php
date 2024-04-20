<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News_controller extends Private_controller {
    
    public function __construct() {
        parent::__construct();
        //load the needed libs, models, etc...
        $this->load->library("Curl");
        $this->load->library("AdminAPI");
    }

    public function newsList() {
        try {
            $AdminAPI = new AdminAPI();
            $list = $AdminAPI->get('news');
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/news/list', 
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
    
    public function editNews($idnew) {
        try {
            $AdminAPI = new AdminAPI();
            $news = $AdminAPI->get('news/'.$idnew);
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/news/edit', 
                        array(
                            "news" => $news
                        ), 
                        true)
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function delNews($idnew = 1) {
        try {
            //need to get menu data with curl 
            $AdminAPI = new AdminAPI();
            $news = $AdminAPI->get('news/'.$idnew);
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/news/del', 
                        array(
                            "news" => $news
                        ), 
                        true)
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
