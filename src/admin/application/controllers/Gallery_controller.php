<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_controller extends Private_controller {
    
    public function __construct() {
        parent::__construct();
        //load the needed libs, models, etc...
        $this->load->library("Curl");
        $this->load->library("AdminAPI");
    }

    public function galleryList() {
        try {
            $AdminAPI = new AdminAPI();
            $list = $AdminAPI->get('gallery');
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/gallery/list', 
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
    
    public function newGallery() {
        try {
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/gallery/new', array(), true)
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function editGallery($idgallery = 1) {
        try {
            //need to get gallery data with curl 
            $AdminAPI = new AdminAPI();
            $gallery = $AdminAPI->get('gallery/'.$idgallery);
            $positions = $AdminAPI->get('positions', array("type"=>'gallery'));
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/gallery/edit', 
                        array(
                            "gallery" => $gallery,
                            "positions" => $positions
                        ), 
                        true)
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function delGallery($idgallery = 1) {
        try {
            //need to get gallery data with curl 
            $AdminAPI = new AdminAPI();
            $gallery = $AdminAPI->get('gallery/'.$idgallery);
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/gallery/del', 
                        array(
                            "gallery" => $gallery
                        ), 
                        true)
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
