<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_controller extends Private_controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('tables/Banner');
        $this->load->model('tables/BannerItem');
    }

    /**
     * Banner save
     * Banner Params in _POST
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
            $Banner = new Banner();
            if (array_key_exists('idbanner', $post) && $post["idbanner"] > 1) {
                if (!$Banner->get($post["idbanner"], true)) {
                    throw new Exception("Menü nem található!", 500);
                }
                $Banner->update($post["idbanner"], $post);
            } else {
                $post["idbanner"] = $Banner->insert($post);
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
    
    public function get($idbanner = 1) {
        try {
            $Banner = new Banner();
            $BannerItem = new BannerItem();
            if (!($idbanner > 1)) {
                //list
                $get_data = $this->input->get();
                $banner = $Banner->get_banner_by_filters($get_data);
            } else {
                $banner = $Banner->get($idbanner, true);
                $banner["banner_items"] = $BannerItem->get_banner_items_by_filters(array("idbanner" => $idbanner));
            }
            echo json_encode($banner);
        } catch (Exception $exc) {
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }

}
