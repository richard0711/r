<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Lister_controller extends Private_controller {
    
    public function __construct() {
        parent::__construct();
        //load the needed libs, models, etc...
        $this->load->library("Curl");
        $this->load->library("AdminAPI");
    }

    public function lister() {
        try {
            $params = $this->input->get();
            $AdminAPI = new AdminAPI();
            $list = $AdminAPI->get($params["api"], $params["get_data"]);
            echo json_encode(array(
                "count"=>$list["count"],
                "list"=> $this->load->view('pages/'.$params["module"].'/'.$params["view"], 
                    array(
                        'list' => $list
                    ),
                true
                )
            ));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
