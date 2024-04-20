<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Content_controller extends Public_controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('tables/Content');
        $this->load->model('tables/ContentItem');
        $this->load->model('tables/Gallery');
        $this->load->model('tables/GalleryItem');
    }
    
    public function get($idcontent = 1) {
        try {
            $Content = new Content();
            $ContentItems = new ContentItem();
            $Gallery = new Gallery();
            $GalleryItems = new GalleryItem();
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
                $contents["gallery"] = ($contents["idgallery"]>1) ? $Gallery->get($contents["idgallery"], true) : array();
                if (count($contents["gallery"]) > 0) {
                    $contents["gallery"]["gallery_items"] = $GalleryItems->get_gallery_items_by_filters(array("idgallery"=>$contents["idgallery"]));
                }
            }
            echo json_encode($contents);
        } catch (Exception $exc) {
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }

}
