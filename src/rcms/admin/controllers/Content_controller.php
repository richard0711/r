<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Content_controller extends Private_controller {

    /**
     * Content save
     * Content Params in POST payment
     */
    public function save() {
        try {
            $this->load->model('tables/Contents');
            $post = $this->input->post();
            
            $Content = new Content();
            if (array_key_exists('idcontent', $post) &&
                $post["idcontent"] > 1) {
                $content_row = $Content->get($post["idcontent"]);
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
