<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registration_controller extends Private_controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Reg save
     * Reg Params in POST payment
     */
    public function set() {
        try {
            $this->db->trans_begin();
            $result = array(
                "errorCode" => 0,
                "msg" => '',
                "data" => array()
            );
            $post = $this->input->post();
            $result["data"] = $post;
            $this->db->trans_commit();
            echo json_encode($result);
        } catch (Exception $exc) {
            $this->db->trans_rollback();
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }

}
