<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Content_controller extends Private_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('tables/Content');
        $this->load->model('tables/ContentItem');
    }

    /**
     * Content save
     * Content Params in POST payment
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
            $Content = new Content();
            if (array_key_exists('idcontent', $post) && $post["idcontent"] > 1) {
                if (!$Content->get($post["idcontent"], true)) {
                    throw new Exception("Tartalom nem található!", 500);
                }
                if (isset($post["content"])) {
                    $post["content"] = base64_decode($post["content"]);
                }
                if (isset($post["published"])) {
                    $post["published"] = str_replace(".", "-", $post["published"]);
                }
                if (isset($post["published_to"])) {
                    $post["published_to"] = str_replace(".", "-", $post["published_to"]);
                }
                $Content->update($post["idcontent"], $post);
            } else {
                $post["content"] = base64_decode($post["content"]);
                $post["published"] = str_replace(".", "-", $post["published"]);
                $post["published_to"] = str_replace(".", "-", $post["published_to"]);
                $post["idcontent"] = $Content->insert($post);
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

    public function get($idcontent = null) {
        try {
            $Content = new Content();
            $ContentItem = new ContentItem();
            if (!($idcontent > 1)) {
                //list
                $get_data = $this->input->get();
                $contents = $Content->get_contents_by_filters($get_data);
            } else {
                $contents = $Content->get($idcontent, true);
                $contents["content_items"] = $ContentItem->get_content_items_by_filters(array("idcontent" => $idcontent));
            }
            echo json_encode($contents);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
