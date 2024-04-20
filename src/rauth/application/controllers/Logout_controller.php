<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logout_controller extends Private_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('UserLib');
        $this->load->model('tables/User');
        $this->load->model('tables/Token');
    }

    /**
     * logout
     * logout Params in POST payment
     */
    public function logout() {
        try {
            $this->db->trans_begin();
            $result = array(
                "errorCode" => 0,
                "msg" => '',
                "data" => array()
            );
            $Token = $this->input->post('Token');
            $System = $this->input->post('System');
            $UserLib = new UserLib();
            //params validate
            $result_of_tvalidate = $UserLib->tokenValidate($Token, $System);
            if ($result_of_tvalidate["idtoken"] > 1) {
                //token gen
                $result["data"] = array(
                    "logged_out" => (int)$UserLib->delToken(array("idtoken" => $result_of_tvalidate["idtoken"]))
                );
            } else {
                throw new Exception("Sikertelen kijelentkezés!", 500);
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
