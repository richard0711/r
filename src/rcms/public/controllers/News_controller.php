<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News_controller extends Public_controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('tables/News');
        $this->load->model('tables/NewItem');
    }
    
    public function get($idnew = 1) {
        try {
            $News = new News();
            $NewItem = new NewItem();
            if (!($idnew > 1)) {
                //list
                $get_data = $this->input->get();
                $news_list = $News->get_news_by_filters($get_data);
                foreach ($news_list["data"] as &$n) {
                    $n["news_items"] = $NewItem->get_new_items_by_filters(array("idnew" => $n["idnew"]));
                }
            } else {
                $news_list = $News->get($idnew, true);
                $news_list["news_items"] = $NewItem->get_new_items_by_filters(array("idnew" => $idnew));
            }
            echo json_encode($news_list);
        } catch (Exception $exc) {
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }

}
