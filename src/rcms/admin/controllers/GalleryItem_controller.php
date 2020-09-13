<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class GalleryItem_controller extends Private_controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('tables/GalleryItem');
    }

    /**
     * GalleryItem save
     * GalleryItem Params in _POST
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
                $GalleryItem = new GalleryItem();
                if (array_key_exists('idgallery_item', $post_item) && $post_item["idgallery_item"] > 1) {
                    if (!$GalleryItem->get($post_item["idgallery_item"], true)) {
                        throw new Exception("Galéria elem nem található!", 500);
                    }
                    $GalleryItem->update($post_item["idgallery_item"], $post_item);
                } else {
                    $post_item["idgallery_item"] = $GalleryItem->insert($post_item);
                }
                $result["data"][] = $post_item;
            }
            $result["data"] = $post;
            $this->db->trans_commit();
            echo json_encode($result);
        } catch (Exception $exc) {
            $this->db->trans_rollback();
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }
    
    public function get($idgallery_item = 1) {
        try {
            $GalleryItem = new GalleryItem();
            if (!($idgallery_item > 1)) {
                $get_data = $this->input->get();
                $gallery_items = $GalleryItem->get_gallery_items_by_filters($get_data);
            } else {
                $gallery_items = $GalleryItem->get($idgallery_item, true);
            }
            echo json_encode($gallery_items);
        } catch (Exception $exc) {
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }

}
