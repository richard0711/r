<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Token_controller extends Private_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('UserLib');
        $this->load->model('tables/User');
        $this->load->model('tables/Token');
    }

    /**
     * tokeninfo
     * tokeninfo Params in POST payment
     */
    public function tokeninfo() {
        try {
            $this->db->trans_begin();
            $result = array(
                "errorCode" => 0,
                "msg" => '',
                "data" => array()
            );
            $Token = $this->input->get('Token');
            $System = $this->input->get('System');
            $UserLib = new UserLib();
            //params validate
            $result_of_tvalidate = $UserLib->tokenValidate($Token, $System);
            if ($result_of_tvalidate["idtoken"] > 1) {
                $result["data"] = $result_of_tvalidate;
            } else {
                throw new Exception("Hozzáférés megtagadva!", 403);
            }
            $this->db->trans_commit();
            echo json_encode($result);
        } catch (Exception $exc) {
            $this->db->trans_rollback();
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }

}
