<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_controller extends Public_controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('tables/Menu');
        $this->load->model('tables/MenuItem');
    }
    
    public function get($idmenu = 1) {
        try {
            $Menu = new Menu();
            $MenuItem = new MenuItem();
            if (!($idmenu > 1)) {
                //list
                $get_data = $this->input->get();
                $menu = $Menu->get_menu_by_filters($get_data);
                foreach ($menu["data"] as &$m) {
                    $m["menu_items"] = $MenuItem->get_menu_items_by_filters(array("idmenu" => $m["idmenu"]));
                }
            } else {
                $menu = $Menu->get($idmenu, true);
                $menu["menu_items"] = $MenuItem->get_menu_items_by_filters(array("idmenu" => $idmenu));
            }
            echo json_encode($menu);
        } catch (Exception $exc) {
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }

}
