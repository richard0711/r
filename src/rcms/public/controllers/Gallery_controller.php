<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_controller extends Public_controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('tables/Gallery');
        $this->load->model('tables/GalleryItem');
    }
    
    public function get($idgallery = 1) {
        try {
            $Gallery = new Gallery();
            $GalleryItems = new GalleryItem();
            if (!($idgallery > 1)) {
                //list
                $get_data = $this->input->get();
                $gallerys = $Gallery->get_gallery_by_filters($get_data);
                foreach ($gallerys["data"] as &$c) {
                    $c["gallery_items"] = $GalleryItems->get_gallery_items_by_filters(array("idgallery" => $c["idgallery"]));
                }
            } else {
                $gallerys = $Gallery->get($idgallery, true);
                $gallerys["gallery_items"] = $GalleryItems->get_gallery_items_by_filters(array("idgallery" => $idgallery));
            }
            echo json_encode($gallerys);
        } catch (Exception $exc) {
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }

}
