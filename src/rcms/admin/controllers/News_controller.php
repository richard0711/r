<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News_controller extends Private_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('tables/News');
    }

    /**
     * News save
     * News Params in POST payment
     */
    public function save() {
        try {
            $this->db->trans_begin();
            $result = array(
                "errorCode" => 0,
                "msg" => '',
                "data" => array()
            );
            $post = $this->input->post();
            $News = new News();
            if (array_key_exists('idnew', $post) && $post["idnew"] > 1) {
                if (!$News->get($post["idnew"], true)) {
                    throw new Exception("Tartalom nem található!", 500);
                }
                $post["content"] = base64_decode($post["content"]);
                $post["published"] = str_replace(".", "-", $post["published"]);
                $post["published_to"] = str_replace(".", "-", $post["published_to"]);
                $News->update($post["idnew"], $post);
            } else {
                $post["content"] = base64_decode($post["content"]);
                $post["published"] = str_replace(".", "-", $post["published"]);
                $post["published_to"] = str_replace(".", "-", $post["published_to"]);
                $post["idnew"] = $News->insert($post);
            }
            $result["data"] = $post;
            $this->db->trans_commit();
            echo json_encode($result);
        } catch (Exception $exc) {
            $this->db->trans_rollback();
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }

    public function get($idnew = null) {
        try {
            $News = new News();
            if (!($idnew > 1)) {
                //list
                $get_data = $this->input->get();
                $news_res = $News->get_news_by_filters($get_data);
            } else {
                $news_res = $News->get($idnew, true);
            }
            echo json_encode($news_res);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
