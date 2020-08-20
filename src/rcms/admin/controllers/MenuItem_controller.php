<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MenuItem_controller extends Private_controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('tables/MenuItem');
    }
        

    /**
     * MenuItem save
     * MenuItem Params in _POST
     */
    public function save() {
        try {
            $this->db->trans_begin();
            $result = array(
                "errorCode" => 0,
                "msg" => '',
                "data" => array()
            );
            $post = $this->input->post();
            foreach ($post as $post_item) {
                $MenuItem = new MenuItem();
                if (array_key_exists('idmenu_item', $post_item) && $post_item["idmenu_item"] > 1) {
                    if (!$MenuItem->get($post_item["idmenu_item"], true)) {
                        throw new Exception("Menüpont nem található!", 500);
                    }
                    $MenuItem->update($post_item["idmenu_item"], $post_item);
                } else {
                    $post_item["idmenu_item"] = $MenuItem->insert($post_item);
                }
                $result["data"][] = $post_item;
            }
            $this->db->trans_commit();
            echo json_encode($result);
        } catch (Exception $exc) {
            $this->db->trans_rollback();
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }
    
    public function get($idmenu = 1) {
        try {
            $Menu = new Menu();
            $MenuItem = new MenuItem();
            $menu = $Menu->get($idmenu, true);
            $menu["menu_items"] = $MenuItem->get_menu_items_by_filters(array("idmenu" => $idmenu));
            echo json_encode($menu);
        } catch (Exception $exc) {
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }

}
