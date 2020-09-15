<?php

class Content extends CI_Model {
    
    protected $table = "contents";
    protected $primary_key = "idcontent";

    public function __construct() {
        parent::__construct();
    }

    public function get($id, $assoc = false){
        $this->db->select($this->table.'.*');
        return (!$assoc) 
            ? $this->db->get_where($this->table, array($this->primary_key => $id))->row() 
            : $this->db->get_where($this->table, array($this->primary_key => $id))->row_array();
    }

    public function get_all() {
        $this->db->select($this->table.'.*');
        $query = $this->db->get_where($this->table, array('status' => 1));
        return $query->result();
    }
    
    public function get_contents_by_filters($filters = array()){
        $result = array('count' => 0, 'data' => array());
        $this->db->from($this->table);
        $this->db->select($this->table.'.*');
        if (isset($filters["idcontent"]) && $filters["idcontent"] > 1) {
            $this->db->where($this->table.".idcontent", $filters["idcontent"]);
        }
        if (isset($filters["position_code"]) && $filters["position_code"] != '') {
            $this->db->join("positions", "positions.idposition=contents.idposition");
            $this->db->where("positions.code", $filters["position_code"]);
        }
        if (isset($filters["string"]) && $filters["string"] != '') {
            $this->db->where("(contents.title like '%".$filters["string"]."%' OR "
                    . "contents.short_desc like '%".$filters["string"]."%' OR "
                    . "contents.content like '%".$filters["string"]."%')");
        }
        $this->db->where("(".$this->table.".published is not null and ".$this->table.".published <= '".date("Y-m-d")."' and (".$this->table.".published_to >= '".date("Y-m-d")."' or ".$this->table.".published_to is null))");
        $this->db->where($this->table.".status", 1);
        $result['count'] = $this->db->count_all_results('', false);
        set_query_limit_and_offset($filters, $this->db);
        $res = $this->db->get();
        log_message('debug', 'get_contents_by_filters $this->db->last_query()'.print_r($this->db->last_query(), true));
        $result['data'] = $this->get_result_array($res);
        return $result;
    }
    
    public function get_result_array($result) {
        $data = array();
        if ($result->num_rows() > 0) {
            foreach ($result->result_array() as $row) {
                $data[] = $row;
            }
        }
        $result->free_result();
        return $data;
    }
     
}