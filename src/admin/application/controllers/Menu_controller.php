<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_controller extends Private_controller {
    
    public function __construct() {
        parent::__construct();
        //load the needed libs, models, etc...
        $this->load->library("Curl");
        $this->load->library("AdminAPI");
    }

    public function menuList() {
        try {
            $AdminAPI = new AdminAPI();
            $list = $AdminAPI->get('menu');
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/menu/list', 
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
    
    public function editMenu($idmenu = 1) {
        try {
            //need to get menu data with curl 
            $AdminAPI = new AdminAPI();
            $menu = $AdminAPI->get('menu/'.$idmenu);
            $contents = $AdminAPI->get('contents');
            $positions = $AdminAPI->get('positions', array("type"=>'menu'));
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/menu/edit', 
                        array(
                            "menu" => $menu,
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
    
    public function delMenu($idmenu = 1) {
        try {
            //need to get menu data with curl 
            $AdminAPI = new AdminAPI();
            $menu = $AdminAPI->get('menu/'.$idmenu);
            $this->load->view("index", 
                array(
                    "content" => $this->load->view('pages/menu/del', 
                        array(
                            "menu" => $menu
                        ), 
                        true)
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
