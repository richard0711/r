<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Position_controller extends Private_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('tables/Position');
    }
    
    public function get($idposition = null) {
        try {
            $Position = new Position();
            if (!($idposition > 1)) {
                //list
                $get_data = $this->input->get();
                $positions = $Position->get_positions_by_filters($get_data);
            } else {
                $positions = $Position->get($idposition, true);
            }
            echo json_encode($positions);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
