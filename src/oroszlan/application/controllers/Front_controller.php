<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Front_controller extends Public_controller {

    public function index() {
        try {
            $this->load->view("index", 
                array(
                    "content" => $this->_getContent()
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * page request handler
     * @param string $page
     * @param string $action
     * @param string $params
     */
    public function page($page = null, $action = null, $params = null) {
        try {
            $this->load->view("index", 
                array(
                    "content" => $this->_getContent(
                        array(
                            "page" => $page,
                            "action" => $action,
                            "params" => $params
                        )
                    )
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    private function _getContent($params = array()) {
        $page = (isset($params["page"])) ?: '';
        switch ($page) {
            case 'news':
                return $this->load->view('pages/news', array(), true);
            default:
                return $this->load->view('pages/home', array(), true);
        }
    }

}
