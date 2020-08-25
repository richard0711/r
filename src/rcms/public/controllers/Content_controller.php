<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Content_controller extends Public_controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('tables/Content');
        $this->load->model('tables/ContentItem');
    }
    
    public function get($idcontent = 1) {
        try {
            $Content = new Content();
            $ContentItems = new ContentItem();
            if (!($idcontent > 1)) {
                //list
                $get_data = $this->input->get();
                $contents = $Content->get_contents_by_filters($get_data);
                foreach ($contents["data"] as &$c) {
                    $c["content_items"] = $ContentItems->get_content_items_by_filters(array("idcontent" => $c["idcontent"]));
                }
            } else {
                $contents = $Content->get($idcontent, true);
                $contents["content_items"] = $ContentItems->get_content_items_by_filters(array("idcontent" => $contents["idcontent"]));
            }
            echo json_encode($contents);
        } catch (Exception $exc) {
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }

}
