<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_controller extends Private_controller {
    
    public function __construct() {
        parent::__construct();
        //load the needed libs, models, etc...
        $this->load->library("Curl");
        $this->load->library("AdminAPI");
    }

    public function bannerList() {
        try {
            $AdminAPI = new AdminAPI();
            $list = $AdminAPI->get('banners');
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/banner/list', 
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
    
    public function newBanner() {
        try {
            $AdminAPI = new AdminAPI();
            $positions = $AdminAPI->get('positions', array("type"=>'banner'));
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/banner/new', 
                        array(
                            "positions" => $positions
                        ), 
                        true)
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function editBanner($idbanner = 1) {
        try {
            //need to get banner data with curl 
            $AdminAPI = new AdminAPI();
            $banner = $AdminAPI->get('banner/'.$idbanner);
            $contents = $AdminAPI->get('contents');
            $positions = $AdminAPI->get('positions', array("type"=>'banner'));
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/banner/edit', 
                        array(
                            "banner" => $banner,
                            "contents" => $contents,
                            "positions" => $positions
                        ), 
                        true)
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function delMenu($idbanner = 1) {
        try {
            //need to get banner data with curl 
            $AdminAPI = new AdminAPI();
            $banner = $AdminAPI->get('banner/'.$idbanner);
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/banner/del', 
                        array(
                            "banner" => $banner
                        ), 
                        true)
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
