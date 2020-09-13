<?php

class Token extends CI_Model {
    
    protected $table = "tokens";
    protected $primary_key = "idtoken";
    
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

    public function insert($data = array()) {
        if ($this->db->insert($this->table, $data)) {
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }

    public function update($id, $data) {
        $this->db->where($this->table.".".$this->primary_key, $id);
        $res = $this->db->update($this->table, $data);
        return $res;
    }

    public function delete($id){
        return $this->db->delete($this->table, array($this->primary_key => $id)); 
    }
    
    public function get_token_by_filters($filters = array()){
        $result = array('count' => 0, 'data' => array());
        $this->db->from($this->table);
        $this->db->select($this->table.'.*');
        if (isset($filters["idtoken"]) && $filters["idtoken"] > 1) {
            $this->db->where($this->table.".idtoken", $filters["idtoken"]);
        }
        if (isset($filters["iduser_system"]) && $filters["iduser_system"] > 1) {
            $this->db->where($this->table.".iduser_system", $filters["iduser_system"]);
        }
        if (isset($filters["system"]) && $filters["system"] != '') {
            $this->db->select('user_system.iduser');
            $this->db->join("user_system", "user_system.iduser_system=tokens.iduser_system");
            $this->db->join("systems", "user_system.idsystem=systems.idsystem");
            $this->db->where("systems.code", $filters["system"]);
        }
        if (isset($filters["token"]) && $filters["token"] != '') {
            $this->db->where($this->table.".token", $filters["token"]);
        }
        $this->db->where($this->table.".status", 1);
        $result['count'] = $this->db->count_all_results('', false);
        set_query_limit_and_offset($filters, $this->db);
        $res = $this->db->get();
        log_message('debug', 'get_token_by_filters $this->db->last_query()'.print_r($this->db->last_query(), true));
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