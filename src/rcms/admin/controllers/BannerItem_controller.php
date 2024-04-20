<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BannerItem_controller extends Private_controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('tables/BannerItem');
    }

    /**
     * BannerItem save
     * BannerItem Params in _POST
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
                $BannerItem = new BannerItem();
                if (array_key_exists('idbanner_item', $post_item) && $post_item["idbanner_item"] > 1) {
                    if (!$BannerItem->get($post_item["idbanner_item"], true)) {
                        throw new Exception("Banner elem nem található!", 500);
                    }
                    $BannerItem->update($post_item["idbanner_item"], $post_item);
                } else {
                    $post_item["idbanner_item"] = $BannerItem->insert($post_item);
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
    
    public function get($idbanner_item = 1) {
        try {
            $BannerItem = new BannerItem();
            if (!($idbanner_item > 1)) {
                $get_data = $this->input->get();
                $banner_items = $BannerItem->get_banner_items_by_filters($get_data);
            } else {
                $banner_items = $BannerItem->get($idbanner_item, true);
            }
            echo json_encode($banner_items);
        } catch (Exception $exc) {
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }

}
