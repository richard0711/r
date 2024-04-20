<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Image_controller extends Private_controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('tables/Image');
    }

    public function upload() {
        try {
            $this->db->trans_begin();
            $result = array(
                "errorCode" => 0,
                "msg" => '',
                "data" => array()
            );
            log_message('debug', "image upload".print_r($_FILES, true));
            $tempFile = $_FILES['file1']['tmp_name'];
            $file = file_get_contents($tempFile);
            $fileName = basename($_FILES['file1']['name']);
            $fileName = sanitize_filename($fileName);
            if (strrpos($fileName, '.') != FALSE) {
                $extension = strtolower(substr($fileName, (strrpos($fileName, '.') + 1)));
            } else {
                $extension = "";
            }
            $filesize = $_FILES['file1']['size'];
            $only_name = str_replace(".".$extension, "", $fileName);
            $saved = write_file('uploaded_files/' . $fileName, $file);
            if (!$saved) {
                log_message('debug', "image upload error ".print_r('uploaded_files/' . $fileName, true));
                throw new Exception('A fájl mentése sikertelen volt.', 500);
            }
            $image_data = array(
                "path" => 'uploaded_files/' . $fileName,
                "extension" => $extension,
                "size" => $filesize,
                "title" => $only_name,
                "x" => 0,
                "y" => 0,
                "status" => 1
            );
            $Image = new Image();
            $image_data["idimage"] = $Image->insert($image_data);
            $result["data"] = $image_data;
            $this->db->trans_commit();
            echo json_encode($result);
        } catch (Exception $exc) {
            $this->db->trans_rollback();
            $this->handleError($exc);
            log_message("error", $exc->getTraceAsString());
        }
    }

}
