<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_controller extends Private_controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('tables/Gallery');
        $this->load->model('tables/GalleryItem');
    }

    /**
     * Gallery save
     * Gallery Params in _POST
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
            $Gallery = new Gallery();
            if (array_key_exists('idgallery', $post) && $post["idgallery"] > 1) {
                if (!$Gallery->get($post["idgallery"], true)) {
                    throw new Exception("Menü nem található!", 500);
                }
                $Gallery->update($post["idgallery"], $post);
            } else {
                $post["idgallery"] = $Gallery->insert($post);
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
    
    public function get($idgallery = 1) {
        try {
            $Gallery = new Gallery();
            $GalleryItem = new GalleryItem();
            if (!($idgallery > 1)) {
                //list
                $get_data = $this->input->get();
                $gallery = $Gallery->get_gallery_by_filters($get_data);
            } else {
                $gallery = $Gallery->get($idgallery, true);
                $gallery["gallery_items"] = $GalleryItem->get_gallery_items_by_filters(array("idgallery" => $idgallery));
            }
            echo json_encode($gallery);
        } catch (Exception $exc) {
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }

}
