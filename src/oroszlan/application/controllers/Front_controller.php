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
     * @param string $id
     */
    public function page($page = null, $id = null) {
        try {
            $get_data = $this->input->get();
            $this->load->view("index", 
                array(
                    "content" => $this->_getContent(
                        array(
                            "page" => $page,
                            "id" => $id,
                            "params" => $get_data
                        )
                    )
                )
            );
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    private function _getContent($pparams = array()) {
        $page = (isset($pparams["page"])) ? $pparams["page"] : '';
        $id = (isset($pparams["id"])) ? $pparams["id"] : '';
        $params = (isset($pparams["params"])) ? $pparams["params"] : '';
        $page_params = $this->_getCommonParams();
        switch ($page) {
            case 'news':
                $page_params["news"] = $this->_getParamsByPage($page, $id, $params);
                $page_view = 'pages/news';
                break;
            case 'news_list':
                $page_params["news_list"] = $this->_getParamsByPage($page, $id, $params);
                $page_view = 'pages/news_list';
                break;
            case 'content':
                $page_params["content"] = $this->_getParamsByPage($page, $id, $params);
                $page_view = 'pages/content';
                break;
            case 'gallery':
                $page_params["gallery"] = $this->_getParamsByPage($page, $id, $params);
                $page_view = 'pages/gallery';
                break;
            case 'content_list':
                $page_params["content_list"] = $this->_getParamsByPage($page, $id, $params);
                $page_view = 'pages/content_list';
            case 'search':
                $page_params["search_list"] = $this->_getSearchResult($params);
                $page_params["search_string"] = $params["s"];
                $page_view = 'pages/search_list';
                break;
            default:
                $page_view = 'pages/home';
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
        $common_params["home_page_news"] = $PublicAPI->get("news/list");
        if (ENVIRONMENT == 'development') { log_message("debug", "common_params :: ".print_r($common_params, true)); }
        return $common_params;
    }
    
    private function _getParamsByPage($page, $id, $params) {
        $PublicAPI = new PublicAPI();
        $api_route = $page;
        if ($id != '') {
            $api_route .= '/'.$id;
        }
        if (ENVIRONMENT == 'development') { log_message("debug", "api_route :: ".print_r($api_route, true)); }
        $page_params = $PublicAPI->get($api_route, $params);
        if (ENVIRONMENT == 'development') { log_message("debug", "page_params :: ".print_r($page_params, true)); }
        return $page_params;
    }
    
    private function _getSearchResult($params) {
        $PublicAPI = new PublicAPI();
        $search_result["contents"] = $PublicAPI->get("content/list", array("string" => $params['s']));
        $search_result["news"] = $PublicAPI->get("news/list", array("string" => $params['s']));
        $search_result["gallery"] = $PublicAPI->get("gallery/list", array("string" => $params['s']));
        //var_dump($search_result);
        return $search_result;
    }

}
