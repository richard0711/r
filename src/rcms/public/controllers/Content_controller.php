<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Content_controller extends Public_controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('tables/Content');
    }
    
    public function get($idcontent = 1) {
        try {
            $Content = new Content();
            if (!($idcontent > 1)) {
                //list
                $get_data = $this->input->get();
                $contents = $Content->get_contents_by_filters($get_data);
            } else {
                $contents = $Content->get($idcontent, true);
            }
            echo json_encode($contents);
        } catch (Exception $exc) {
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }

}
