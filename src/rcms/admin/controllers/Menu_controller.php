<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_controller extends Private_controller {

    /**
     * Menu save
     * Menu Params in POST payment
     */
    public function save() {
        try {
            $this->load->model('tables/Menus');
            $post = $this->input->post();
            
            $Menu = new Menus();
            if (array_key_exists('idmenu', $post) &&
                $post["idmenu"] > 1) {
                $content_row = $Menu->get($post["idcontent"]);
            }
            
            
            
            echo json_encode($content_row);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function get() {
        try {
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
