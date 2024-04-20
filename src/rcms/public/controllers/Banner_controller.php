<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_controller extends Public_controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('tables/Banner');
        $this->load->model('tables/BannerItem');
    }
    
    public function get($idbanner = 1) {
        try {
            $Banner = new Banner();
            $BannerItem = new BannerItem();
            if (!($idbanner > 1)) {
                //list
                $get_data = $this->input->get();
                $banners = $Banner->get_banner_by_filters($get_data);
                foreach ($banners["data"] as &$b) {
                    $b["banner_items"] = $BannerItem->get_banner_items_by_filters(array("idbanner" => $b["idbanner"]));
                }
            } else {
                $banners = $Banner->get($idbanner, true);
                $banners["banner_items"] = $BannerItem->get_banner_items_by_filters(array("idbanner" => $idbanner));
            }
            echo json_encode($banners);
        } catch (Exception $exc) {
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }

}
