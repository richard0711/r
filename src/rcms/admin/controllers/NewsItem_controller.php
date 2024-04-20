<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class NewsItem_controller extends Private_controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('tables/NewItem');
    }

    /**
     * NewsItem save
     * NewsItem Params in _POST
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
                $NewsItem = new NewItem();
                if (array_key_exists('idnew_item', $post_item) && $post_item["idnew_item"] > 1) {
                    if (!$NewsItem->get($post_item["idnew_item"], true)) {
                        throw new Exception("Hír elem nem található!", 500);
                    }
                    $NewsItem->update($post_item["idnew_item"], $post_item);
                } else {
                    $post_item["idnew_item"] = $NewsItem->insert($post_item);
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
    
    public function get($idnew_item = 1) {
        try {
            $NewsItem = new NewItem();
            if (!($idnew_item > 1)) {
                $get_data = $this->input->get();
                $news_items = $NewsItem->get_new_items_by_filters($get_data);
            } else {
                $news_items = $NewsItem->get($idnew_item, true);
            }
            echo json_encode($news_items);
        } catch (Exception $exc) {
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }

}
