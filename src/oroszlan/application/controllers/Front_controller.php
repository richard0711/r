<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Front_controller extends Public_controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library("Curl");
        $this->load->library("PublicAPI");
    }

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
     */
    public function page($page = null, $action = null) {
        try {
            $this->load->view("index", 
                array(
                    "content" => $this->_getContent(
                        array(
                            "page" => $page,
                            "action" => $action
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
        $action = (isset($params["action"])) ?: '';
        $page_view = 'pages/home';
        $page_params = $this->_getCommonParams();
        switch ($page) {
            case 'news':
                $page_params["news"] = $this->_getParamsByPage($page, $action, $params);
                $page_view = 'pages/news';
            default:
                break;
        }
        return $this->load->view($page_view, $page_params, true);
    }
    
    private function _getCommonParams() {
        $common_params = array();
        $PublicAPI = new PublicAPI();
        $common_params["top_menu"] = $PublicAPI->get("menu/list", array("position_code" => 'top_menu'));
        $common_params["home_page_banners"] = $PublicAPI->get("banner/list", array("position_code" => 'home_page_top'));
        $common_params["home_page_doctors"] = $PublicAPI->get("content/list", array("position_code" => 'home_page_doctors'));
        $common_params["home_page_welcome"] = $PublicAPI->get("content/list", array("position_code" => 'home_page_welcome'));
        $common_params["news"] = $PublicAPI->get("news/list");
        if (ENVIRONMENT == 'development') { log_message("debug", "common_params :: ".print_r($common_params, true)); }
        return $common_params;
    }
    
    private function _getParamsByPage($page, $action, $params) {
//        $common_params = array();
//        $PublicAPI = new PublicAPI();
//        $common_params["content_list"] = $PublicAPI->get($page."/".$action, $params);
//        return $common_params;
    }

}
