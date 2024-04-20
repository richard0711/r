<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ContentItems_controller extends Private_controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('tables/ContentItem');
    }

    /**
     * ContentItem save
     * ContentItem Params in _POST
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
                $ContentsItem = new ContentItem();
                if (array_key_exists('idcontent_item', $post_item) && $post_item["idcontent_item"] > 1) {
                    if (!$ContentsItem->get($post_item["idcontent_item"], true)) {
                        throw new Exception("Tartalom elem nem található!", 500);
                    }
                    $ContentsItem->update($post_item["idcontent_item"], $post_item);
                } else {
                    $post_item["idcontent_item"] = $ContentsItem->insert($post_item);
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
    
    public function get($idcontent_item = 1) {
        try {
            $ContentsItem = new ContentItem();
            if (!($idcontent_item > 1)) {
                $get_data = $this->input->get();
                $contents_items = $ContentsItem->get_content_items_by_filters($get_data);
            } else {
                $contents_items = $ContentsItem->get($idcontent_item, true);
            }
            echo json_encode($contents_items);
        } catch (Exception $exc) {
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }

}
