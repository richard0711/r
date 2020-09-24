<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_controller extends Private_controller {
    
    public function __construct() {
        parent::__construct();
        //load the needed libs, models, etc...
        $this->load->library("Curl");
        $this->load->library("AdminAPI");
    }

    public function index() {
        try {
            $AdminAPI = new AdminAPI();
            $last_contents = $AdminAPI->get('contents', array("limit"=>5, "offset"=>0));
            $last_news = $AdminAPI->get('news', array("limit"=>5, "offset"=>0));
            $last_gallery = $AdminAPI->get('gallery', array("limit"=>5, "offset"=>0));
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/dashboard/dashboard', 
                        array(
                            'last_contents' => $last_contents,
                            'last_news' => $last_news,
                            'last_gallery' => $last_gallery
                        ), 
                        true
                    )
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
