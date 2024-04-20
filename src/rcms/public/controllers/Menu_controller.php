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
                    $m["menu_items"] = $MenuItem->get_menu_items_by_filters(array("idmenu" => $m["idmenu"], "parent_menu_item_id" => 1));
                    foreach ($m["menu_items"]["data"] as &$mmenu_item) {
                        $mmenu_item["childs"] = $this->_getChilds($mmenu_item["idmenu_item"]);
                    }
                }
            } else {
                $menu = $Menu->get($idmenu, true);
                $menu["menu_items"] = $MenuItem->get_menu_items_by_filters(array("idmenu" => $idmenu, "parent_menu_item_id" => 1));
            }
            echo json_encode($menu);
        } catch (Exception $exc) {
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }
    
    private function _getChilds($parent_menu_item_id = null) {
        $MenuItem = new MenuItem();
        $childs = $MenuItem->get_menu_items_by_filters(array("parent_menu_item_id" => $parent_menu_item_id));
        foreach ($childs["data"] as &$child) {
            $child["childs"] = $this->_getChilds($child["idmenu_item"]);
        }
        return $childs;
    }

}
