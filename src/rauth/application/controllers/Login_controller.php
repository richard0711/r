<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends Public_controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('UserLib');
        $this->load->model('tables/User');
        $this->load->model('tables/UserPassword');
        $this->load->model('tables/Token');
    }

    /**
     * login
     * login Params in POST payment
     */
    public function login() {
        try {
            $this->db->trans_begin();
            $result = array(
                "errorCode" => 0,
                "msg" => '',
                "data" => array()
            );
            $post = $this->input->post();
            $UserLib = new UserLib();
            //params validate
            $result_of_uvalidate = $UserLib->userValidate($post);
            if ($result_of_uvalidate["iduser"] > 1) {
                //token gen
                $result["data"] = array(
                    "name" => $result_of_uvalidate["name"],
                    "token" => $UserLib->setToken($result_of_uvalidate)
                );
            } else {
                throw new Exception("Sikertelen bejelentkezés!", 500);
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
